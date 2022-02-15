<?= $helper->getHeadPrintCode('Editar '.$entity_class_name) ?>

{% block body %}

<h5 class="card-header bg-secondary text-light" ><i class="fa fa-edit"></i>
    Editar <?= $entity_class_name ?> index </h5>
<hr/>
    {{ include('<?= $templates_path ?>/_form.html.twig') }}

<hr/>
<ul>
    <li style="display: inline-flex">
        <a href="{{ path('<?= $route_name ?>_index') }}" class="btn btn-outline-info btn-back" data-toggle="tooltip" data-placement="top"
           title="Volver"
        ><i class="fa fa-arrow-left"></i></a>
    </li>
    <li style="display: inline-flex">
        {{ include('<?= $templates_path ?>/_delete_form.html.twig') }}
    </li>
</ul>

{% endblock %}
