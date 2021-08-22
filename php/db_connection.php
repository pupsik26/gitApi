<?php

function connectToDb() {
    $host = 'localhost';
    $dbname = 'db';
    $username = 'root';
    $password = 'root';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        return $pdo;
    } catch (PDOException $e) {
        return ("Невозможно соединиться с базой данных. Ошибка:" .$e->getMessage());
    }
}

function apiGit($subject) {
    $url = "https://api.github.com/search/repositories?q=$subject";
    $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';

    $curl = curl_init($url);
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => $agent
    ]);
    $resp = curl_exec($curl);
    return $resp;
}

function showData($subject) {
    $allData = [];

    $rez = json_decode($subject, true);
    foreach ($rez[items] as $item) {
        array_push($allData, [
            'name' => $item[name], 
            'login' => $item[owner][login],
            'url' => $item[owner][html_url],
            'stargazers_count' => $item[stargazers_count],
            'watchers_count' => $item[watchers_count]
        ]);
    }
    return $allData;
}

function findDataDb($name) {
    $pdo = connectToDb();
    $sql = "SELECT * from project where name = '$name'";
    $q = $pdo->query($sql);
    $result = $q->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $pdo = null;
        return showData($result['json']);
    } else return $result;
}

function insertDataDb($name, $json) {
    $pdo = connectToDb();
    try {  
        $data = array( 'name' => $name, 'json' => $json );
        $query = $pdo->prepare("INSERT INTO project (name, json) values (:name, :json)");
        $query->execute($data);
        return true;
    } catch (PDOException $e) {
        print "Ошибка!: " . $e->getMessage() . "<br/>";
        return false;
    }
}
$data = findDataDb($_POST['data']);
if (empty($data)) {
    $json = apiGit($_POST['data']);
    insertDataDb($_POST['data'], $json);
    $data = findDataDb($_POST['data']);
}

?>

<?php if(!empty($data)): ?>
<div class="container">
    <div class="row">
        <?php foreach($data as $value): ?>
            <div class="col-4 mt-3">
                <a href="<?= $value[url] ?>" class="card-link">
                    <div class="card" style="width: 18rem;">
                        <img src="https://miro.medium.com/freeze/max/1200/1*xJdaL3X77BKCFqJfHt-Hpw.gif" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Name: <?= $value['name']?> </h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Login: <?= $value['login'] ?></li>
                            <li class="list-group-item">Stargazers: <?= $value['stargazers_count'] ?></li>
                            <li class="list-group-item">Watchers: <?= $value['watchers_count'] ?></li>
                        </ul>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?else:?>
    <div class="container">
        Данных нет
    </div>
<?php endif ?>


