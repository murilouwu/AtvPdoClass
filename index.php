<?php
    include('fun.php');
    require 'User.php';

    if($_POST){
        if(isset($_POST['submit'])){
            $user = new User();
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];

            $user->setUser($pdo, $user->name, $user->email, $user->password);
        }else if(isset($_POST['submit-confirm'])){
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
            $user = new User();
            $user->updateUser($pdo, $_GET['id'], $_POST['name'], $_POST['email']);
            
        }else if(isset($_POST['submit-cancel'])){
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
        }
    }

    if($_GET){
        if(isset($_GET['id']) && $_GET['type'] == "delete" ){
            $user = new User();
            $user->deleteUser($pdo, $_GET['id']);
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
        }
    }
    HeaderEcho(
        'Home', 
        [
            [0, 'http-equiv="X-UA-Compatible" content="IE=edge"'],
            [0, 'name="viewport" content="width=device-width, initial-scale=1.0"'],
            [1, 'assets/css/index.css'],
            [2, 'assets/java/script.js'],
            [2, 'https://kit.fontawesome.com/39cab4bf95.js', 'crossorigin="anonymous"'],
            [2, 'https://code.jquery.com/jquery-3.2.1.slim.js', 'integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"'],
        ],
        'assets/imgs/logo.png'
    );
?>
<body>
    <div class="container" id="Cadastros">
        <?php
            if($_GET){
                if(isset($_GET['id']) && $_GET['type'] == "edit" ){    
                    $user = new User();
                    $stmt = $user->selectUser($pdo, "", "WHERE cd = ".$_GET['id']);
                    foreach($stmt as $row){
                        echo '
                        <div class="card">
                            <div class="card-image" style="background-image: url(\'assets/imgs/rino2.png\');">	
                                <h2 class="card-heading">
                                    Editar<br>
                                    <small>Editar User '.$row['cd'].'- '.$row['nome'].'</small>
                                </h2>
                            </div>
                            <form class="card-form" method="post">
                                <input hidden type="text" name="cd" value="'.$row['cd'].'">
                                <div class="input">
                                    <input type="text" class="input-field" name="name" id="name" placeholder="Digite o nome aqui" value="'.$row['nome'].'" required/>
                                    <label class="input-label">Full name</label>
                                </div>
                                <div class="input">
                                    <input type="email" class="input-field" name="email" id="email" placeholder="Digite o email aqui" value="'.$row['email'].'" required/>
                                    <label class="input-label">Email</label>
                                </div>
                                <div class="action">
                                    <button class="action-button" name="submit-confirm">Editar</button>
                                    <button class="action-button" name="submit-cancel">Cancelar</button>
                                </div>
                            </form>
                        </div>
                        ';
                    }
                }
            }
        ?>
        <div class="card">
            <div class="card-image">	
                <h2 class="card-heading">
                    Cadastrar<br>
                    <small>Cadastre aqui um Cliente</small>
                </h2>
            </div>
            <form class="card-form" method="post" name="frmcadastro">
                <div class="input">
                    <input type="text" class="input-field" name="name" id="name" placeholder="Digite o nome aqui" required/>
                    <label class="input-label">Full name</label>
                </div>
                <div class="input">
                    <input type="email" class="input-field" name="email" id="email" placeholder="Digite o email aqui" required/>
                    <label class="input-label">Email</label>
                </div>
                <div class="input">
                    <input type="password" class="input-field" name="password" id="password" placeholder="Digite a senha aqui" required/>
                    <label class="input-label">Password</label>
                </div>
                <div class="action">
                    <button class="action-button" name="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
    
    <button class="btnTable" onclick="Table('.btnTable', ['#Cadastros', '#Table'], 0)"><i class="fa-solid fa-table"></i></button>
    
    <div class="BigTable" id="Table">
        <button class="btnTableIN" onclick="Table('.btnTable', ['#Cadastros', '#Table'], 1)"><i class="fa-solid fa-user-plus"></i></button>
        <table class="table">
            <?php
                $user = new User();
                $stmt = $user->selectUser($pdo, "", "");
                if($stmt->rowcount() == 0){
                    echo '
                    <tr class="Top">
                        <th class="total">Não há Cadastrados</th>
                    </tr>
                    ';
                }else{
                    echo '
                        <tr class="Top">
                            <th class="total">Usuários cadastrados:</th>
                        </tr>
                        <tr class="Top">
                            <th id="tb-id">ID</td>
                            <th id="tb-nm">Nome</td>
                            <th id="tb-em">Email</td>
                            <th id="tb-fn">Funções</td>
                        </tr>
                    ';
                    foreach($stmt as $row){
                        echo '
                            <tr>
                                
                            </tr>
                        <tr>
                            <td>'.$row['cd'].'</td>
                            <td>'.$row['nome'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>
                                <a href="?id='.$row['cd'].'&type=edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="?id='.$row['cd'].'&type=delete"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        ';
                    }
                }
            ?>
        </table>
    </div>
</body>
<?php
    footEcho();
?>