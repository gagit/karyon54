public function get<?= $class_name ?>Filter($filter)
{
    $qb = $this->createQueryBuilder('q')
        ->select('q');
    <?php foreach ($entity_fields as $field): ?>
    <?php if( $field != 'id') {?>
    if($filter->{{ field }}) {
        $qb->andWhere($qb->expr()->eq('q.<?= $field ?>', ':<?= $field ?>'))
                ->setParameter(:'<?= $field ?>', $filter-><?= $field ?>);
    }
    <?php } ?>
    <?php endforeach; ?>
    return  $qb;
}
