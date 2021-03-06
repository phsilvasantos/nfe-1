<?php

if (!isset($_POST['nome'])) {
    header("location:./");
} else if (trim($_POST['nome'] == "") || trim($_POST['nome'] == null) || trim($_POST['id'] == "") || trim($_POST['id'] == null) || trim($_POST['codigo_athos'] == "") || trim($_POST['codigo_athos'] == null)) {
    header("location:./");
} else {
    require('../externo/connect.php');

    date_default_timezone_set('America/Sao_Paulo');
    $n = mb_convert_case(trim($_POST['nome']), MB_CASE_UPPER, 'utf-8');
    $athos = mb_convert_case(trim($_POST['codigo_athos']), MB_CASE_UPPER, 'utf-8');
    $cod = mb_convert_case(trim($_POST['id']), MB_CASE_UPPER, 'utf-8');
    $img = $_FILES['imagem']['name'];

    $pesquisar = mysqli_query($connect, "SELECT * FROM $vendas WHERE $nome = '$n'");
    $numero_produtos = mysqli_fetch_array($pesquisar);
?>
    <html lang="en">

    <head>
        <title>NF-e | Cadastrar Produtos</title>
        <link rel="shortcut icon" href="../imagens/nfe.ico" type="image/x-icon">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../externo/style.css">
        <script src="../jquery/jquery-3.4.0.min.js"></script>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modalCadastrado').modal('show');
            });
        </script>
    </head>

    <body>
        <?php if ($numero_produtos > 0) { ?>
            <div class="modal fade" id="modalCadastrado" tabindex="-1" role="dialog" aria-labelledby="modalCadastradoTitle" aria-hidden="true" onblur="window.location.replace('./')" onkeypress="window.location.replace('./')">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTitle">
                                <font class="text-warning"><?php echo $n . " já existe!" ?></font>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.replace('./')">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <h5 class="lead"><?php echo $n ?> já foi cadastrado uma vez!</h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location.replace('./')">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else if ($n == "" && $athos == "" && $cod == "") { ?>
            <div class="modal fade" id="modalCadastrado" tabindex="-1" role="dialog" aria-labelledby="modalCadastradoTitle" aria-hidden="true" onblur="window.location.replace('./')" onkeypress="window.location.replace('./')">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTitle">
                                <font class="text-danger">Nenhuma informação fornecida!</font>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.replace('./')">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <h5 class="lead">Nome, código Athos e referência do produto não foram fornecidos!</h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location.replace('./')">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else if ($n == "" || $athos == "" || $cod == "") { ?>
            <div class="modal fade" id="modalCadastrado" tabindex="-1" role="dialog" aria-labelledby="modalCadastradoTitle" aria-hidden="true" onblur="window.location.replace('./')" onkeypress="window.location.replace('./')">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTitle">
                                <?php if (($n == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $n)) && ($athos == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $athos))) { ?>
                                    <font class="text-danger">Nome e código Athos não fornecidos!</font>
                                <?php } else if (($n == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $n)) && ($cod == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $cod))) { ?>
                                    <font class="text-danger">Nome e referência não fornecidos!</font>
                                <?php } else if (($athos == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $athos)) && ($cod == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $cod))) { ?>
                                    <font class="text-danger">Código Athos e referência não fornecidos!</font>
                                <?php } else if ($n == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $n)) { ?>
                                    <font class="text-danger">Nenhum nome fornecido!</font>
                                <?php } else if ($athos == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $athos)) { ?>
                                    <font class="text-danger">Nenhum código Athos fornecido!</font>
                                <?php } else if ($cod == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $cod)) { ?>
                                    <font class="text-danger">Nenhuma referência fornecida!</font>
                                <?php } ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.replace('./')">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <?php if (($n == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $n)) && ($athos == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $athos))) { ?>
                                    <h5 class="lead">O nome e código Athos do produto não foram fornecidos!</h5>
                                <?php } else if (($n == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $n)) && ($cod == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $cod))) { ?>
                                    <h5 class="lead">O nome e referência do produto não foram fornecidos!</h5>
                                <?php } else if (($athos == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $athos)) && ($cod == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $cod))) { ?>
                                    <h5 class="lead">O código Athos e referência do produto não foram fornecidos!</h5>
                                <?php } else if ($n == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $n)) { ?>
                                    <h5 class="lead">O nome do produto não foi fornecido!</h5>
                                <?php } else if ($athos == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $athos)) { ?>
                                    <h5 class="lead">O código Athos do produto não foi fornecido!</h5>
                                <?php } else if ($cod == "" || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $cod)) { ?>
                                    <h5 class="lead">A referência do produto não foi fornecida!</h5>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location.replace('./')">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="modal fade" id="modalCadastrado" tabindex="-1" role="dialog" aria-labelledby="modalCadastradoTitle" aria-hidden="true" onblur="window.location.replace('./')" onkeypress="window.location.replace('./')">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTitle">
                                <font class="text-success"><?php echo $n . " cadastrado com sucesso!" ?></font>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.replace('./')">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <?php
                                // Adicionando imagem
                                if (isset($_FILES['imagem'])) {
                                    $file_size = $_FILES['imagem']['size'];
                                    $file_tmp = $_FILES['imagem']['tmp_name'];
                                    $file_type = $_FILES['imagem']['type'];
                                    $file_explode = explode('.', $img);
                                    $file_ext = strtolower(end($file_explode));
                                    $nome_sem_extensao = strtolower($file_explode[0]);
                                    $nome_novo = $nome_sem_extensao . " " . date("d.m.Y-H.i.s") . "." . $file_ext;

                                    $dir = '../produtos/';
                                    $extensions = array("jpeg", "jpg", "png", "gif");
                                    
                                    if ($file_ext == "") {
                                        #
                                        $adicionar = mysqli_query($connect, "INSERT INTO $vendas(cod_athos, id, nome, quantidade, imagem) VALUES('$athos','$cod', '$n', '0', '')");
                                    }
                                    else if (in_array($file_ext, $extensions) === false) {
                                        echo "<span class='text-muted'>Arquivo inválido, somente JPEG, PNG ou GIF são aceitos.</span><br>";
                                        $adicionar = mysqli_query($connect, "INSERT INTO $vendas(cod_athos, id, nome, quantidade, imagem) VALUES('$athos','$cod', '$n', '0', '')");
                                    } else {
                                        move_uploaded_file($file_tmp, $dir . $nome_novo);
                                        $adicionar = mysqli_query($connect, "INSERT INTO $vendas(cod_athos, id, nome, quantidade, imagem) VALUES('$athos','$cod', '$n', '0', '$nome_novo')");
                                    }
                                }
                                if ($adicionar) { ?>
                                    <div class="row">
                                        <div class="col-4" style="text-align: right; padding: 0px; margin-left: -35px">
                                            <h5 class="font-weight-bold">Nome:</h5>
                                        </div>
                                        <div class="col" style="padding-left: 10px">
                                            <h5 class="lead"><?php echo $n ?></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4" style="text-align: right; padding: 0px; margin-left: -35px">
                                            <h5 class="font-weight-bold">Cód. Athos:</h5>
                                        </div>
                                        <div class="col" style="padding-left: 10px">
                                            <h5 class="lead"><?php echo $athos ?></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4" style="text-align: right; padding: 0px; margin-left: -35px">
                                            <h5 class="font-weight-bold">Referência:</h5>
                                        </div>
                                        <div class="col" style="padding-left: 10px">
                                            <h5 class="lead"><?php echo $cod ?></h5>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location.replace('./')">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </body>

    </html>

<?php }
