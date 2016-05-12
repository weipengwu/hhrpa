<?php require(PLUGIN_ROOT . '/views/header.php');?>

<div class="wrap">
    <h2>HHRPA Organizations <a href="?page=hhrpa-organizations-details" class="add-new-h2">Add New Organization</a></h2>

    <table class="widefat">
        <thead>
            <tr>
                <th>Organization Name</th>
                <th>Organization City</th>
                <th>Organization Phone Number</th>
            </tr>
        </thead>
        
        <tbody>
            <?php  foreach ($organizations as $organization): ?>
                <tr>
                    <td>
                        <a href="?page=hhrpa-organizations-details&id=<?php echo  $organization->id ?>"><?php echo  $organization->name ?> <?php echo  $member->last_name ?></a>
                    </td>
                    <td><?php echo  $organization->city ?></td>
                    <td><?php echo  $organization->phone ?></td>
               </tr>
            <?php  endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <th>Organization Name</th>
                <th>Organization City</th>
                <th>Organization Phone Number</th>
            </tr>
        </tfoot>
    </table>
    
</div>