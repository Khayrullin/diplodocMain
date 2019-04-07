<h1>Список пользователей</h1>
<p>Список всех пользователей, доступных для редактирования</p>


<table cellpadding=0 cellspacing=10>
	<tr>
		<th>Имя</th>
		<th>Фамилия</th>
		<th><?php echo lang('index_email_th');?></th>
		<th>Группа</th>
		<th>Статус</th>
		<th>Действия</th>
	</tr>
	<?php foreach ($users as $user):?>
		<tr>
            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, 'Редактировать') ;?></td>
		</tr>
	<?php endforeach;?>
</table>

<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>

<form>
    <button formaction="<? echo base_url().'auth/logout'?>">Выйти</button>
</form>