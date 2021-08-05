<?php if(!class_exists('Rain\Tpl')){exit;}?><body>
    <header>
		<img class="img-fluid cabeclho-img" src="/assets/site/img/angelo.png">
        <div class="bottom">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <div class="text-center">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Início</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/empreendimento">Empreendimentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/loteamento">Loteamentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/imoveis">Imóveis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contato">Contato</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-favorites" href="/imoveisfavorites">Favoritos <?php if( $count_favorites > 0 ){ ?><span class="badge badge-primary"><?php echo htmlspecialchars( $count_favorites, ENT_COMPAT, 'UTF-8', FALSE ); ?></span><?php } ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link facebook-link" target="_blank" href="https://www.facebook.com/angelocorrreta"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link instagram-link" target="_blank" href="https://www.instagram.com/angelo_corretor/"><i class="fab fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="banner">
        <br><br><br><br>
        <div class="card-search">
            <h5>Pesquise Aqui</h5>
            <form method="get" action="/resultadoBusca">
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <select required name="locacaoVendaRural" id="tipoimovel" class="form-control">
							<option value="" disabled selected>Selecione uma opção</option>
                            <option value="venda">Imóveis a Venda</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <select required name="tipoImovel" id="tipoimoveis" class="form-control">
                            <option value="" selected disabled>Tipo Imóvel</option>
                            <?php $counter1=-1;  if( isset($tipoimoveis) && ( is_array($tipoimoveis) || $tipoimoveis instanceof Traversable ) && sizeof($tipoimoveis) ) foreach( $tipoimoveis as $key1 => $value1 ){ $counter1++; ?>

                            <option value="<?php echo htmlspecialchars( $value1["tipo_imovel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["tipo_imovel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <select name="estado" id="estado" class="form-control">
                            <option value="">Estado</option>
							<?php $counter1=-1;  if( isset($estados) && ( is_array($estados) || $estados instanceof Traversable ) && sizeof($estados) ) foreach( $estados as $key1 => $value1 ){ $counter1++; ?>

								<option value="<?php echo htmlspecialchars( $value1["estado_uf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
							<?php } ?>

                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <select name="cidade" id="cidadeEscolha" class="form-control">
                            <option value="">Cidade</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <select name="bairro" id="bairrosEscolha" class="form-control">
                            <option value="">Bairro</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <input name="precomin" type="text" class="form-control" id="precomin" placeholder="Preco min">
                    </div>
                    <div class="form-group col-sm-6">
                        <input name="precomax" type="text" class="form-control" id="precomax" placeholder="Preco max">
                    </div>
                </div>
                <button class="btn btn-success">Buscar</button>
            </form>
        </div>
    </div>
    <div class="container-sm setcontainer">
        <div class="text-center">
            <h2 class="color-tema"><?php echo htmlspecialchars( $count_destaques, ENT_COMPAT, 'UTF-8', FALSE ); ?> Destaques</h2>
        </div><br>
        <div class="row">
            <?php $counter1=-1;  if( isset($imoveis_destaque) && ( is_array($imoveis_destaque) || $imoveis_destaque instanceof Traversable ) && sizeof($imoveis_destaque) ) foreach( $imoveis_destaque as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-md-4">
                <div class="card-base">
                    <div data-url="<?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="cards-content">
                        <?php if( $value1["foto_capa"] != 'nulo' ){ ?>

                            <img class="imageCard img-fluid" src="<?php echo htmlspecialchars( $value1["foto_capa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"/><br>
                        <?php } ?>

                        <div class="card-conteudo">
                            <?php if( $value1["valor"] == 0.00 ){ ?>

                                <p>Valor sob consulta</p>
                            <?php }else{ ?>

                                <div class="preco text-center">
                                    R$ <?php echo decimal($value1["valor"]); ?>

                                </div>
                            <?php } ?>

                            <h4><?php echo htmlspecialchars( $value1["tipo_imovel"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["Bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
                            <p><?php echo htmlspecialchars( $value1["status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                            <div class="dados">
                                <?php if( $value1["dormitorios"] > 0 ){ ?>

                                    <div class="conteudodados">
                                        <div class="text-center">
                                            <i class="fas fa-bed"></i><br>
                                        </div>
                                        <?php echo htmlspecialchars( $value1["dormitorios"], ENT_COMPAT, 'UTF-8', FALSE ); ?> dorms
                                    </div>
                                <?php } ?>

                                <?php if( $value1["banheiros"] > 0 ){ ?>

                                    <div class="conteudodados">
                                        <div class="text-center">
                                            <i class="fas fa-shower"></i><br>
                                        </div>
                                        <?php echo htmlspecialchars( $value1["banheiros"], ENT_COMPAT, 'UTF-8', FALSE ); ?> w.c
                                    </div>
                                <?php } ?>

                                <?php if( $value1["garagens"] > 0 ){ ?>

                                    <div class="conteudodados">
                                        <div class="text-center">
                                            <i class="fas fa-car"></i><br>
                                        </div>
                                        <?php echo htmlspecialchars( $value1["garagens"], ENT_COMPAT, 'UTF-8', FALSE ); ?> vagas
                                    </div>
                                <?php } ?>

                                <?php if( $value1["terreno"] > 0 ){ ?>

                                    <div class="conteudodados">
                                        <div class="text-center">
                                            <i class="fas fa-border-style"></i><br>
                                        </div>
                                        <?php echo decimal($value1["terreno"]); ?> m²
                                    </div>
                                <?php } ?>

                            </div><br>
                            <div class="codigo">
                                Código: <?php echo htmlspecialchars( $value1["codigo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php if( inFavorites($value1["url"]) == false ){ ?>

                            <h3 style="color: #04315D;"><div class="favorites-add-remove" data-favorites="add" data-url="<?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="far fa-heart favorites"></i></div></h3>
                        <?php }else{ ?>

                            <h3 style="color: #04315D;"><div  class="favorites-add-remove" data-favorites="remove" data-url="<?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-heart removefavorites"></i></div></h3>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div><br>
    <div class="fab-container">
        <ul class="fab-options">
            <li id="whatsapp">
                <span class="fab-label">Whatsapp</span>
                <div class="fab-icon-holder">
                    <i class="fab fa-whatsapp"></i>
                </div>
            </li>
        </ul>
    </div>
</body>