<?= $helper->getHeadPrintCode('Nueva '.$entity_class_name) ?>

{% block body %}

<h5 class="card-header bg-secondary text-light" ><i class="fa fa-plus"></i>
    Nueva <?= $entity_class_name ?> </h5>
<hr/>
    {{ include('<?= $templates_path ?>/_form.html.twig') }}
<hr/>
<ul>
    <li style="display: inline-flex">
        <a href="{{ path('<?= $route_name ?>_index') }}" class="btn btn-outline-info btn-back" data-toggle="tooltip" data-placement="top"
           title="Volver"
        ><i class="fa fa-arrow-left"></i></a>
    </li>
</ul>

{% endblock %}
