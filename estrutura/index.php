<?php
 $servername = "localhost";
 $username = "root";
 $password = "root";
 $dbname = "sistema_bloco_notas_caua";

 $conn = new mysqli($servername, $username, $password, $dbname);

 if ($conn->connect_error) {
     die("Conexão falhou: " . $conn->connect_error);
 }

$sql = "SELECT * FROM mensagens";

$result = $conn -> query($sql);

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['register'])){
        $mensagem = $_POST['text'];
        $author = $_POST['author'];

        if(strlen($mensagem) > 255){
            $mensagem = mb_substr($mensagem, 0, 255);
        }

        $sql = "INSERT INTO mensagens (id,author,mensagem) VALUE (null,'$author','$mensagem')";

        if ($conn ->query($sql) === false) {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }else{
            header ("Location: index.php");
        }  
    }elseif(isset($_POST['save'])){
        $id = $_POST['id'];
        $mensagem = $_POST['text'];

        if(strlen($mensagem) > 255){
            $mensagem = mb_substr($mensagem, 0, 255);
        }

        $sql = "UPDATE mensagens SET mensagem='$mensagem' WHERE id=$id";

        if ($conn ->query($sql) === false) {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }else{
            header ("Location: index.php");
        }
    }elseif(isset($_POST['delete'])){
        $id = $_POST['id'];
        
        $sql = "delete from mensagens WHERE id=$id";

        if ($conn ->query($sql) === false) {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }else{
            header ("Location: index.php");
        }
    }
}       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    
    <div id="form-data">
        
        <form method="POST" action="index.php">
            <h1>Bloco de notas</h1>
            <div id="fields">
                    <div class="label">
                        <label for="author">Autor:</label> 
                    </div>
                    <div class="input">
                        <input type="string" id="author" name="author">
                    </div>
                    <div class="label">
                        <label for="text">Texto:</label> 
                    </div>
                    <div class="input">
                        <textarea type="string" id="text" name="text" rows="4" cols="49" required></textarea>
                    </div>
            </div>
            <div id="button">
                <button type="submit" name="register">Enviar</button>
            </div>
        </form>
    </div>
    <section id="table">
    <?php
        if ($result -> num_rows > 0){
            echo "<div id='messages'>";
                while($row = $result -> fetch_assoc()){
                    echo "<table border='1'>
                            <tr>
                                <th> ID </th>
                                <th> Autor </th>
                                <th> Texto </th>
                            </tr>";
                    echo "<form action='index.php' method='POST'>
                            <tr>
                                <td> <input name='id' class='show id' value='{$row['id']}' readonly></input> </td>
                                <td> <input name='author' class='show author' value='{$row['author']}' readonly></input> </td>
                                <td> <textarea type='string' id='text' name='text' rows='4' cols='49'>{$row['mensagem']}</textarea></td>
                                <td>
                                    <button type='submit' name='save'>Salvar</button>
                                </td>
                                <td>
                                    <button type='submit' name='delete'>Excluir</button>
                                </td>
                            </tr>
                        </form>";
                    echo "</table>";
                }
            echo "</div>";
        }else{
            echo "Nenhum registro encontrado.";
        }
        $conn -> close();
    ?>
    
    </section>
    
</body>
</html>