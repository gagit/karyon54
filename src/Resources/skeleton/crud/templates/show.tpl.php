<h5 class="card-header bg-secondary text-light" ><i class="fa fa-eye"></i>
    Ver <?= $entity_class_name ?> </h5>
<hr/>
    <table class="table table-striped">
        <tbody>
<?php foreach ($entity_fields as $field): ?>
            <tr>
                <th><?= ucfirst($field['fieldName']) ?></th>
                <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
<hr/>
<ul>
    <li style="display: inline-flex">
        <a href="{{ path('<?= $route_name ?>_index') }}" class="btn btn-outline-info btn-back" data-toggle="tooltip" data-placement="top"
           title="Volver"
        ><i class="fa fa-arrow-left"></i></a>
    </li>
    <li style="display: inline-flex">
        <a href="{{ path('<?= $route_name ?>_edit', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}" class="btn btn-outline-info btn-back" data-toggle="tooltip" data-placement="top"
           title="Editar"
        ><i class="fa fa-edit"></i></a>
    </li>
    <li style="display: inline-flex">
        {{ include('<?= $templates_path ?>/_delete_form.html.twig') }}
    </li>
</ul>
