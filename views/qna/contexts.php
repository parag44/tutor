<?php 

$contexts =  array(
    'qna-table' => array(
        'columns' => array(
            'checkbox'      => '<div class="d-flex"><input type="checkbox" id="tutor-bulk-checkbox-all" class="tutor-form-check-input" /></div>',
            'student'       => __('Student', 'tutor'),
            'question'      => __('Question', 'tutor'),
            'reply'         => __('Reply', 'tutor'),
            'waiting_since' => __('Waiting Since', 'tutor'),
            'status'        => __('Status', 'tutor'),
            'action'        => __('Action', 'tutor'),
        ),
        'contexts' => array(
            'frontend-dashboard-qna-table' => array(
                'student',
                'question',
                'reply',
                'status',
                'action'
            ),
            'backend-dashboard-qna-table' => true,
        )
    ),
);

return tutor_utils()->get_table_columns_from_context($page_key, $context, $contexts, 'tutor/qna/table/column');