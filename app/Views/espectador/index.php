<div class="container py-5">

    <?= Alertas::mensagem('espectador') ?>

    <div class="card">

        <div class="artcor card-header">

            <nav class="navbar">
                <div class="container-fluid">
                    <h5 class="tituloIndex">Espectador</h5>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Pesquisar espectador" aria-label="Search" name="pesquisarEspectador" id="pesquisarEspectador">
                        <a href="<?= URL ?>/EspectadorController/cadastrar" class="btn btn-artcor">Novo Espectador</a>
                    </form>
                </div>
            </nav>

        </div>
        <div class="card-body">
            <div>
                <div id="resultadoEspectador"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        pesquisarEspectador();

        $("#pesquisarEspectador").keyup(function() {
            var ds_nome_espectador = $(this).val();
            if (ds_nome_espectador != "") {
                pesquisarEspectador(ds_nome_espectador);
            } else {
                pesquisarEspectador();
            }
        });
    });


    //Ajax para gerar e buscar os visitantes cadastrados

    function pesquisarEspectador(ds_nome_espectador) {
        $.ajax({
            url: '<?php echo URL . '/EspectadorController/buscaAjaxEspectador' ?>',
            type: 'POST',
            data: {
                ds_nome_espectador: ds_nome_espectador
            },
            success: function(data) {
                // loading_hide();
                $("#resultadoEspectador").html(data)
            },
            error: function(data) {
                console.log("Ocorreu erro ao BUSCAR espectador via AJAX.");
                // $('#cboCidade').html("Houve um erro ao carregar");
            }
        });
    }
</script>