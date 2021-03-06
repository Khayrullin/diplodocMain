<h1>Профиль</h1>

<table cellpadding=0 cellspacing=10>
	<tr>
		<th>Имя</th>
		<th>Фамилия</th>
		<th>E-mail</th>
		<th>Группы</th>
		<th>Статус</th>
		<th>Действия</th>
	</tr>
	<?php foreach ($user as $usr):?>
		<tr>
            <td><?php echo htmlspecialchars($usr->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($usr->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($usr->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($usr->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($usr->active) ? anchor("auth/deactivate/".$usr->id, lang('index_active_link')) : anchor("auth/activate/". $usr->id, lang('index_inactive_link'));?></td>
			<td><?php echo anchor("auth/edit_user/".$usr->id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
</table>


<form>
    <button formaction="<? echo base_url().'auth/logout'?>">Выйти</button>
</form>