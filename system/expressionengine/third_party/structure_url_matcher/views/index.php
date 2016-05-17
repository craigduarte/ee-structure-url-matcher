<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $this->EE =& get_instance();
?>

<?php foreach ($cp_messages as $cp_message_type => $cp_message) : ?>
	<p class="notice <?=$cp_message_type?>"><?=$cp_message?></p>
<?php endforeach; ?>

<?php	
	echo form_open($action_url);

	$cp_table_template['table_open'] = '<table class="mainTable" border="0" cellspacing="0" cellpadding="0">';

	$this->table->set_template($cp_pad_table_template);
	$this->table->set_heading(
		array(
			'data' => $this->EE->lang->line('entry_id'),
			'style' => 'width:10%;'
		),
		array(
			'data' => $this->EE->lang->line('title'),
			'style' => 'width:30%;'
		),	
		array(
			'data' => $this->EE->lang->line('ee_url'),
			'style' => 'width:30%;'
		),
		array(
			'data' => $this->EE->lang->line('structure_url'),
			'style' => 'width:30%;'
		)
	);


	foreach($unmatched_entries as $entry)
	{
		// url copied from the core "Content > Edit" screen. system/expressionengine/controllers/cp/content_edit.php
		$this->table->add_row(
			$entry['entry_id'], // entry_id
			'<a href="'.BASE.AMP.'C=content_publish'.AMP.'M=entry_form'.AMP.'entry_id='.$entry['entry_id'].'">'.$entry['title'].'</a>', //title
			$entry['url_title'], // url_title
			'<strong>' . $entry['structure_url_last_segment'] . '</strong>' //structure url
		);
	}

	echo $this->table->generate();
	$this->table->clear();	

?>

<div class="tableSubmit">
	<?=form_submit('submit', 'Update all Structure URLs to match URL Titles', 'class="submit"').NBS.NBS?>
</div>

<?php		

	//echo form_submit(array('name' => 'submit', 'value' => $this->EE->lang->line('btn_delete_detours'), 'class' => 'submit'));
	
	echo form_close();

	
?>

	