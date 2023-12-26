<?php get_header(); 

$photoTitle = get_query_var('photographies');

$searchParameters = [
    'post_type' =>'photographies',
    //'name' => $photoTitle,
    'posts_per_page' => 1
];

$postRequest = new WP_Query($searchParameters);
var_dump($postRequest->have_posts());
while ($postRequest->have_posts()){
    var_dump($postRequest->the_post());
    $reference = get_field('type');
    echo $reference;
}
echo 'toto';



get_footer(); ?>