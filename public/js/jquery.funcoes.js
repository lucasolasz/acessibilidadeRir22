//Somente habilita o campo quando o perfil do usuario for colaborador
function disableEditoria() {

    var id_perfil_usuario = $("#cboPerfilUsuario").val();

    $("#cboEditoriaUsuario").prop('disabled', true);

    if (id_perfil_usuario == 4) {
        $("#cboEditoriaUsuario").prop('disabled', false);
    }

}