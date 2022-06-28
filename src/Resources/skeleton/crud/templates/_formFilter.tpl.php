<div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-filter"></i> Filtros
    </a>

    <div class="dropdown-menu">

        {{ form_start(formFilter) }}

        {{ form_widget(formFilter) }}

        <div class="row mt-2">
            <div class="form-group col-md">
                <button class="btn btn-outline-dark"><i class="fa fa-search"></i></button>
            </div>
            <div class="form-group col-md">
                <a class="btn btn-outline-dark" onclick="cleanFilterForm($('#{{'{{ formFiltro.vars.attr.id }}'}}'));"
                   data-toggle="tooltip" data-placement="top"  title="Click para Limpiar los Filtros" data-animation="true">
                    <i class="fa fa-eraser"></i></a>
            </div>
        </div>

        {{ form_end(formFilter, {'render_rest': false}) }}
    </div>
</div>
