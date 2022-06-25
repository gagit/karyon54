{{ form_start(formFilter) }}
<div class="col-md-12">
    <div class="dropdown">
                    <span class="dropdown-toggle btn btn-default "
                          data-toggle="dropdown" id="activa_filtros" name="activa_filtros" ><i class="fa fa-filter"></i> Filtros</span>

    {{ form_widget(formFilter) }}
    </div>
</div>
<div class="row mt-2">
    <div class="form-group col-md">
        <button class="btn btn-outline-dark"><i class="fa fa-search"></i></button>
    </div>
    <div class="form-group col-md">
        <a class="btn btn-outline-dark" onclick="limpiaForm($('#{{'{{ formFiltro.vars.attr.id }}'}}'));"
           data-toggle="tooltip" data-placement="top"  title="Click para Limpiar los Filtros" data-animation="true">
            <i class="fa fa-eraser"></i></a>
    </div>
</div>

{{ form_end(formFilter, {'render_rest': false}) }}
