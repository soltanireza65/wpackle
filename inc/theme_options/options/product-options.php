<?php if (!defined('ABSPATH')) {
  die;
}
$prefix_page_opts = '_prefix_product_options';

CSF::createMetabox($prefix_page_opts, array(
  'title'        => 'مشخصات',
  'post_type'    => 'product',
  'context'            => 'advanced',
  'priority'           => 'high',
  'nav'                => 'normal',
  'show_restore' => false,
));



CSF::createSection($prefix_page_opts, array(
  'title'  => 'اطلاعات بیشتر',
  'icon'   => 'fas fa-rocket',
  'fields' => array(
    array(
      'id'    => 'opt_en_title',
      'type'  => 'text',
      'title' => 'عنوان انگلیسی',
    ),
    array(
      'id'    => 'opt_time_arival',
      'type'  => 'text',
      'title' => 'زمان تحویل',
    ),
  )
));


CSF::createSection($prefix_page_opts, array(
  'title'  => 'مشخصات بارز محصول',
  'icon'   => 'fas fa-rocket',
  'fields' => array(
    array(
      'id'     => 'opt-repeater',
      'type'   => 'repeater',
      'title'  => 'ویژگی های بارز',
      'fields' => array(
        array(
          'id'     => 'opt-fieldset',
          'type'   => 'fieldset',
          'title'  => 'Fieldset',
          'fields' => array(
            array(
              'id'    => 'opt-text-key',
              'type'  => 'text',
              'title' => 'نام',
            ),
            array(
              'id'    => 'opt-text-val',
              'type'  => 'text',
              'title' => 'توضیحات',
            ),
          ),
        ),

      ),
    ),
  )
));
