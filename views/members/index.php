<?php require(PLUGIN_ROOT . '/views/header.php');?>

<div class="wrap">
    <h2>HHRPA Members <a href="?page=hhrpa-members-details" class="add-new-h2">Add New Member</a></h2>

    <table class="widefat">
        <thead>
            <tr>
                <th>Member's Name</th>
                <th>Member's Email</th>
                <th>Member's Title</th>
                <th>Member's Phone Number</th>
                <th>Organization</th>
            </tr>
        </thead>
        
        <tbody>
            <?php  foreach ($members as $member): ?>
                <tr>
                    <td>
                        <a href="?page=hhrpa-members-details&id=<?php echo  $member->id ?>"><?php echo  $member->first_name ?> <?php echo  $member->last_name ?></a>
                    </td>
                    <td><?php echo  $member->email ?></td>
                    <td><?php echo  $member->job_title ?></td>
                    <td><?php echo  $member->phone ?></td>
                    <td><?php echo  $member->organization ?></td>
               </tr>
            <?php  endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <th>Member's Name</th>
                <th>Member's Email</th>
                <th>Member's Title</th>
                <th>Member's Phone Number</th>
                <th>Organization</th>
            </tr>
        </tfoot>
    </table>
    
</div>