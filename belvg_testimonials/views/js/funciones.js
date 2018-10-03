window.onload=function(){
    $(document).ready(function(){
        $(".seleccionar").click(function(){
            $("#seleccionado").val($(this).data("id"));
            $("#operacion").val("editar");
        });
        $(".seleccionar_dos").click(function(){
            $("#seleccionado").val($(this).data("id"));
            $("#operacion").val("editar_dos");
        });
        $(".seleccionar_borrar").click(function(){
            $("#seleccionado").val($(this).data("id"));
            $("#operacion").val("eliminar");
        });
        $(".seleccionar_borrar_dos").click(function(){
            $("#seleccionado").val($(this).data("id"));
            $("#operacion").val("eliminar_dos");
        });
    });
}


