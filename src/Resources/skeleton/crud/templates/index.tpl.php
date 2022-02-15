<?= $helper->getHeadPrintCode($entity_class_name.' index'); ?>

{% block body %}
<h5 class="card-header bg-secondary text-light" ><i class="fa fa-list"></i>
    <?= $entity_class_name ?> index </h5>
<hr/>
    <table class="table table-striped">
        <thead>
            <tr>
<?php foreach ($entity_fields as $field): ?>
                <th><?= ucfirst($field['fieldName']) ?></th>
<?php endforeach; ?>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        {% for <?= $entity_twig_var_singular ?> in <?= $entity_twig_var_plural ?> %}
            <tr>
<?php foreach ($entity_fields as $field): ?>
                <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
<?php endforeach; ?>
                <td>
                    <ul>
                        <li style="display: inline-flex" >
                            <a class="btn btn-outline-dark" href="{{ path('<?= $route_name ?>_show', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}">
                                <i class="fa fa-eye"></i> </a>
                        </li>
                        <li style="display: inline-flex" >
                            <a class="btn btn-outline-dark" href="{{ path('<?= $route_name ?>_edit', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}">
                                <i class="fa fa-edit"></i> </a>
                        </li>
                    </ul>
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan="<?= (count($entity_fields) + 1) ?>">no records found</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
    <hr/>
<a class="btn btn-outline-dark" href="{{ path('<?= $route_name ?>_new') }}">
    <i class="fa fa-plus"></i> </a>
{% endblock %}
