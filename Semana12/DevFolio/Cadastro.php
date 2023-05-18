        <?php
        include 'header.php';
        include 'conexaoBD.php';
        include 'Usuario.php';
        session_start();


        ?>



        <div class="hero hero-single route bg-image" style="background-image: url(assets/img/overlay-bg.jpg)">
            <div class="overlay-mf"></div>
            <div class="hero-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <h2 class="hero-title mb-4">Cadastro</h2>
                        <?php if (isset($_SESSION['cadastrar'])) {
                            echo  $_SESSION['cadastrar'];
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <body>

            <form class="myform" method="POST" action="resultadoCadastro.php">

                <div class="form-group row" style="margin-top: 30px;">
                    <label for="nome" class="col-sm-2 col-form-label my-label" style="margin-left: 250px;">Nome</label>
                    <input type="text" class="form-control input-pequeno" id="nome" name="nome" placeholder="Nome" style="margin-left: -120px; width: 600px; margin-bottom: 30px;">
                </div>
                <div class="form-group row" >
                    <label for="sexo" class="col-sm-2 col-form-label my-label" style="margin-left: 250px;">Sexo</label>
                    <select class="form-control input-pequeno" id="sexo" name="sexo" style="margin-left: -120px; width: 600px; margin-bottom: 30px;">
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                    </select>
                </div>
                <div class="form-group row" >
                    <label for="etnia" class="col-sm-2 col-form-label my-label" style="margin-left: 250px;">Etnia</label>
                    <select class="form-control input-pequeno" id="etnia" name="etnia" style="margin-left: -120px; width: 600px; margin-bottom: 30px;">
                        <option value="Branca">Branca</option>
                        <option value="Amarela">Amarela</option>
                        <option value="Afrodescendente">Afrodescendente</option>
                        <option value="Indigena">Indígena</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="margin-left: 250px;">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" style="margin-left: -120px; width: 600px; margin-bottom: 30px;">
                </div>

                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label" style="margin-left: 250px;">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" style="margin-left: -120px; width: 600px; margin-bottom: 30px;">
                </div>

                <div class="form-group row">
                    <button type="submit" class="btn btn-primary" style="margin-left:550px;  width: 150px;
                    margin-bottom: 30px;">Cadastrar</button>
                </div>
            </form>

            <?php
            include 'footer.php';
            ?>
            </form>
        </body>