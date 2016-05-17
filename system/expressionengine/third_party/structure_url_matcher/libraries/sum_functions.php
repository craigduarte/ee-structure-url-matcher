<?php 

	class Sum_functions {
		protected $site_id = 0;
		
		public function __construct()
		{
			$this->EE =& get_instance();
			$this->site_id = $this->EE->config->item('site_id');
		}

		public function get_channel_entry_data()
		{
			$channel_data_query = $this->EE->db->select('*')
			->from('channel_titles')
			->get();

			return $channel_data_query->result_array();
		}

		public function get_structure_site_data()
		{
			$site_data_query = $this->EE->db->select('site_pages')
			->from('sites')
			->limit(1)
			->where('site_id', $this->site_id)
			->get();

			return unserialize(base64_decode($site_data_query->row('site_pages')));
		}

		public function set_structure_site_data($structure_data = array())
		{

			if(empty($structure_data) || !is_array($structure_data))
			{
				return false;
			}

			$serialized_data = base64_encode(serialize($structure_data));

			$update_data = array(
				'site_pages' => $serialized_data
			);

			$update_site_data_query = $this->EE->db->update('sites', $update_data, "site_id = $this->site_id");

			return $update_site_data_query;
		}

		public function set_structure_url_as_url_title()
		{

			$structure_data = $this->get_structure_site_data();
			$unmatched_entries = $this->get_unmatched_entries();

			foreach($unmatched_entries as $entry)
			{
				$trimmed_structure_url = rtrim(ltrim($entry['original_structure_url'], '/'), '/');
				$structure_url_segments = explode('/', $trimmed_structure_url);
				
				//remove last element from array then add in url_title as the last item
				array_pop($structure_url_segments);
				$structure_url_segments[] = $entry['url_title'];
				$new_structure_url = '/' . implode('/', $structure_url_segments) . '/';

				$structure_data[$this->site_id]['uris'][$entry['entry_id']] = $new_structure_url;
			}

			return $this->set_structure_site_data($structure_data);

		}

		public function get_unmatched_entries()
		{
			$structure_data = $this->get_structure_site_data();
			$channel_entry_data = $this->get_channel_entry_data();

			$unmatched_entries = array();

			foreach($channel_entry_data as $entry)
			{
				//only entries in structure
				if(!empty($structure_data[$this->site_id]['uris'][$entry['entry_id']]))
				{

					$structure_url = $structure_data[$this->site_id]['uris'][$entry['entry_id']];

					//whole structure url, e.g. "/level-1/level-2/level-3/";
					$entry['original_structure_url'] = $structure_url;

					//last segment of structure url, e.g. "level-3" // trim opening/trailing slashes for consistency
					$entry['structure_url_last_segment'] = end(explode('/', rtrim(ltrim($structure_url, '/'),'/')));

					if($entry['structure_url_last_segment'] !== $entry['url_title'])
					{
						$unmatched_entries[] = $entry;
					}
				}
			}

			return $unmatched_entries;
		}
	}
	