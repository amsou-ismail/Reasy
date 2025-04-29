<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "gestion_vols");

if ($conn->connect_error) {
    echo json_encode(["response" => "Erreur de connexion à la base de données."]);
    exit();
}

$question = strtolower($_POST['message']);
$response = "Je ne comprends pas votre demande 😕";

// 1. Réponses aux salutations
$salutations = ["bonjour", "hello", "salut", "hola", "help", "aide", "aider moi","salam","cava"];
foreach ($salutations as $salut) {
    if (strpos($question, $salut) !== false) {
        $reponses_salut = [
            "Bonjour ! Comment puis-je vous aider ?",
            "Salut ! Vous cherchez un vol, un hôtel ou une voiture ?",
            "Bienvenue ! Dites-moi ce que vous cherchez 😊",
        ];
        $response = $reponses_salut[array_rand($reponses_salut)];
        echo json_encode(["response" => $response]);
        exit();
    }
}

// 2. Questions générales sur le site
if (strpos($question, 'site') !== false || strpos($question, 'service') !== false) {
    $response = "Nous proposons des vols entre villes marocaines, la location de voitures et des hôtels à Marrakech. Que souhaitez-vous faire ?";
    echo json_encode(["response" => $response]);
    exit();
}

// 3. Redirection vers hôtels ou voitures
if (strpos($question, 'hôtel') !== false || strpos($question, 'hotel') !== false) {
    $response = "Vous pouvez réserver un hôtel ici : <a href='front/categorie.php?id=9'>Page des hôtels</a>.";
    echo json_encode(["response" => $response]);
    exit();
}
if (strpos($question, 'voiture') !== false || strpos($question, 'location') !== false ||  strpos($question, 'transport') !== false) {
    $response = "Voici notre page pour la location de voiture : <a href='front/categorie.php?id=11'>Location de voitures</a>.";
    echo json_encode(["response" => $response]);
    exit();
}

session_start();

// Initialiser l'état
if (!isset($_SESSION['chatbot_state'])) {
    $_SESSION['chatbot_state'] = ["ville_depart" => null, "ville_arrive" => null];
}
if (!isset($_SESSION['mode_vol'])) {
    $_SESSION['mode_vol'] = false;
}

$state = &$_SESSION['chatbot_state'];
$mode_vol = &$_SESSION['mode_vol'];

// Activer le mode vol si on détecte une intention
if (strpos($question, 'vol') !== false || strpos($question, 'voyager') !== false || strpos($question, 'billet') !== false) {
    $mode_vol = true;
}

// Si on est en mode_vol, continuer l’interaction
if ($mode_vol) {

    // Étape 1 : détecter ville de départ
    if (!$state['ville_depart']) {
        $sql = "SELECT DISTINCT ville_depart FROM vols";
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            if (strpos($question, strtolower($row['ville_depart'])) !== false) {
                $state['ville_depart'] = $row['ville_depart'];
                break;
            }
        }
        if (!$state['ville_depart']) {
            $response = "Depuis quelle ville voulez-vous partir ?";
            echo json_encode(["response" => $response]);
            exit();
        }
    }

    // Étape 2 : détecter ville d'arrivée
    if (!$state['ville_arrive']) {
        $sql = "SELECT DISTINCT ville_arrive FROM vols WHERE ville_depart=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $state['ville_depart']);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            if (strpos($question, strtolower($row['ville_arrive'])) !== false) {
                $state['ville_arrive'] = $row['ville_arrive'];
                break;
            }
        }
        if (!$state['ville_arrive']) {
            $response = "Et quelle est votre destination depuis " . $state['ville_depart'] . " ?";
            echo json_encode(["response" => $response]);
            exit();
        }
    }

    // Étape 3 : si les deux villes sont connues, afficher les vols
    if ($state['ville_depart'] && $state['ville_arrive']) {
        $sql = "SELECT * FROM vols WHERE ville_depart=? AND ville_arrive=? ORDER BY date_vol LIMIT 3";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $state['ville_depart'], $state['ville_arrive']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $infos = [];
            while ($row = $result->fetch_assoc()) {
                $infos[] = $row['nom_avion'] . ", le " . $row['date_vol'] . " à " . $row['heure_vol'] . " — " . $row['prix'] . " MAD";
            }
            $response = "Voici les vols de " . $state['ville_depart'] . " à " . $state['ville_arrive'] . " :<br>" . implode("<br>", $infos);
        } else {
            $response = "Désolé, aucun vol trouvé entre ces deux villes.";
        }

        // Réinitialiser le mode vol et le contexte
        $_SESSION['chatbot_state'] = ["ville_depart" => null, "ville_arrive" => null];
        $_SESSION['mode_vol'] = false;

        echo json_encode(["response" => $response]);
        exit();
    }
}



// 5. Fallback IA si rien ne correspond (à activer avec une vraie clé API)
function call_openai_api($prompt) {
    $api_key = "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";
    $data = [
        "model" => "openai/gpt-3.5-turbo", // modèle via OpenRouter, avec le bon nom complet
        "messages" => [
            ["role" => "system", "content" => "Tu es un assistant pour un site de réservation (vols, hôtels, voitures au Maroc). Tu ne réponds que sur ce contexte."],
            ["role" => "user", "content" => $prompt]
        ]
    ];

    $ch = curl_init("https://openrouter.ai/api/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $api_key",
        "Content-Type: application/json",
        "HTTP-Referer: http://localhost/Reasy",       // remplace avec ton site ou localhost
        "X-Title: ReservationBot"                                                 // nom du projet
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $result = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($result, true);
    return $response_data['choices'][0]['message']['content'] ?? "Désolé, je n'ai pas compris.";
}


$response = call_openai_api($question);
echo json_encode(["response" => $response]);
?>



