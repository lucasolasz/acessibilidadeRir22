<div class="container py-5">

    <?= Alertas::mensagem('plataforma') ?>

    <div class="card">

        <div class="artcor card-header">

            <nav class="navbar">
                <div class="container-fluid">
                    <h5 class="tituloIndex">Plataformas</h5>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Pesquisar espectador ou marcação" aria-label="Search" name="pesquisarPlataformaEspec" id="pesquisarPlataformaEspec">
                        <a href="<?= URL ?>/EspectadorController" class="btn btn-artcor">Nova marcação</a>
                    </form>
                </div>
            </nav>

        </div>

        <div class="card-body">
            <div>
                <div id="resultadoPlataforma"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        pesquisarPlataformaEspec();

        $("#pesquisarPlataformaEspec").keyup(function() {
            var ds_nome_espectador = $(this).val();
            if (ds_nome_espectador != "") {
                pesquisarPlataformaEspec(ds_nome_espectador);
            } else {
                pesquisarPlataformaEspec();
            }
        });
    });

    //Ajax para gerar e buscar os visitantes cadastrados

    function pesquisarPlataformaEspec(ds_nome_espectador) {
        $.ajax({
            url: '<?php echo URL . '/PlataformasController/buscaAjaxPlataformaEspectador' ?>',
            type: 'POST',
            data: {
                ds_nome_espectador: ds_nome_espectador
            },
            success: function(data) {
                // loading_hide();
                $("#resultadoPlataforma").html(data)
            },
            error: function(data) {
                console.log("Ocorreu erro ao BUSCAR espectador via AJAX.");
                // $('#cboCidade').html("Houve um erro ao carregar");
            }
        });
    }
</script>