<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Archivos de Texto</title>
    <link rel="stylesheet" href="style.css">
    <!--Bootstrap 5.1-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    
</head>
<body>

    <div class="row">

        <div class="col-md-8 offset-md-2">

            <div class="card card-body">

                <form action="" method="post">
                    <button class="refreshBtn" type="submit" name="refresh" id="refresh">Recargar!</button>

                    <label class="folderLabel" for="folderName">Nombre de carpeta</label>
                    <input class="folderInput" type="text" name="folderName">

                    <label class="fileLabel" for="fileName">Nombre de archivo</label>
                    <input class="fileInput" type="text" name="fileName">

                    <button class="createBtn" type="submit" name="submit" id="submit">Done!</button>
                </form>

            </div>

        </div>

    </div>
    <div class="row">

        <div class="col-md-4 offset-md-2">

            <div class="card card-body">

                <form class="txt-area-input" action="" method="post">

                    <div class="form-group">

                        <label class="txtLabel" for="txtName" class="form-control">Ver Archivo</label>
                        <input class="txtNameInput" type="text" name="txtName">

                        <button class="searchTxt" type="submit" name="txtSubmit1">Ver</button>

                    </div>


                    <br>

                    <textarea name="txtFile" cols="30" rows="8"><?php

                            if(isset($_POST['txtSubmit1'])){
                                
                                if($_POST['txtName'] != null){
                                    $fileName = $_POST['txtName'];
                                    $fileTrueName = $fileName.".txt";
                                    if(file_exists($fileTrueName)){

                                        $file = $fileTrueName;

                                        $current = file_get_contents($file);
                                        echo $current;

                                    }else{
                                        $errorMsg = "El archivo no existe, crealo primero.";
                                        echo $errorMsg;
                                    }

                                }

                            }
                            
                        ?>
                    </textarea>
                </form>

            </div>

        </div>

        <div class="col-md-4">
            <div class="card card-body">
                <form class="txt-area-input" action="" method="post">
                    <label class="txtLabel" for="txtName">Editar Archivo</label>
                    <input class="txtNameInput" type="text" name="txtName">

                    <button class="searchTxt" type="submit" name="txtSubmit">Editar</button>
                    <br>

                    <textarea name="txtFile" cols="30" rows="8"><?php
                    
                    if(isset($_POST['txtSubmit'])){

                        if($_POST['txtName'] != null){
                            $file = $_POST['txtName'];
                            $fileTrueName = $file.".txt";
                            $comment = $_POST['txtFile'];
                            echo "Archivo editado y guardado!";
                            file_put_contents($fileTrueName, $comment);
                        }
                    }
                    
                    ?></textarea>
                </form>
            </div>
        </div>

    </div>

    <!--Bootstrap 5.1 & SCRIPTS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>



    <div class="col-md-8 offset-md-2">

        <div class="card card-body">
            <?php

                $errorMsg = null;
                function displayList(){
                    if ($handle = opendir(".")) {

                        while (false !== ($entry = readdir($handle))) {
                        
                            if ($entry != "." && $entry != "..") {
                        
                                echo "$entry\n <br>";
                            }
                        }
                        
                        echo "<br><br>";

                        closedir($handle);
                    }
                }

                function changeList(){
                    $path = 'carpetadeprueba';
                    if ($handle = opendir($path)) {

                        while (false !== ($entry = readdir($handle))) {
                        
                            if ($entry != "." && $entry != "..") {
                        
                                echo "$entry\n <br>";
                            }
                        }
                        
                        echo "<br><br>";

                        closedir($handle);
                    }
                }

                if (!isset($_POST['submit'])) {

                    displayList();
                    
                }

                if(isset($_POST['submit'])){
                    $folderName = $_POST['folderName'];
                    if($folderName != null){
                        if(file_exists($folderName)){
                            $errorMsg = "La carpeta ya existe!";
                            echo $errorMsg;
                        }else{
                            mkdir($folderName);
                            displayList();
                        }
                    
                    }

                    $fileName = $_POST['fileName'];
                    if($fileName != null){
                        if(file_exists($fileName.".txt")){
                            $errorMsg = "El archivo ya existe!";
                            echo $errorMsg;
                        }else{
                            $createFile = fopen("$fileName.txt", "w");
                            displayList();
                        }
                        
                    }

                    
                    
                }

                if(isset($_POST['txtDone'])){
                    echo "aaaaaaaaaaaaa";
                    $comment = $_POST['txtFile'];
                    echo "$comment";
                    file_put_contents($fileTrueName, $comment);
                }

                if(isset($_POST['refresh'])){
                    require_once('reload.php');
                }

                if(isset($_POST['carpeta'])){
                    changeList();
                }

            ?>
        </div>
    </div>

</body>
</html> 