<?php
class qa_html_theme_layer extends qa_html_theme_base {
    public function nav_main_sub()
    {
        if (qa_opt('nav_ask') && qa_user_maximum_permit_error('permit_post_q') != 'level') {
            if ($this->template == 'tag') {
                $tag = qa_request_part(1);
                $this->content['navigation']['main']['ask']['url'] = qa_path_html('ask', array('tags' => $tag ));
            } elseif ($this->template == 'question') {
                // Rebuild 'Ask a Question' link.
                $params = array();

                if (qa_using_categories()) {
                    $categories = qa_db_select_with_pending(qa_db_category_nav_selectspec($this->content['q_view']['raw']['postid'], true, true, true));
                    $categoryids = array_keys(qa_category_path($categories, $this->content['q_view']['raw']['categoryid']));
                    $lastcategoryid = count($categoryids) > 0 ? end($categoryids) : null;

                    if (strlen($lastcategoryid))
                        $params['cat'] = $lastcategoryid;
                }

                if (qa_using_tags() && isset($this->content['q_view']['raw']['tags']))
                    $params['tags'] = $this->content['q_view']['raw']['tags'];

                $this->content['navigation']['main']['ask']['url'] = qa_path_html('ask', !empty($params) ? $params : null);
            }
        }

        parent::nav_main_sub();
    }

    public function form_fields($form, $columns) {
        $tags = qa_html(trim(qa_get('tags')));

        if ($tags && $this->template == 'ask')
            $form['fields']['tags']['value'] = $tags;

        parent::form_fields($form, $columns);
    }
}
