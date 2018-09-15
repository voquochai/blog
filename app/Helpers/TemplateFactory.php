<?php
namespace App\Helpers;
use App\Helpers\Facades\Tool;
class TemplateFactory {
	public function getTemplateProductPrice($regular_price, $sale_price){
		if( $regular_price > 0 && $sale_price == 0){
			$price = '<span class="new">'.get_currency_vn($regular_price).'</span>';
		}elseif($sale_price > 0){
			$price = '<span class="new">'.get_currency_vn($sale_price).'</span>
			<span class="old">'.get_currency_vn($regular_price).'</span>';
		}else{
			$price = '<span class="new">'.__('site.contact').'</span>';
		}
		return $price;
		
	}
	public function getTemplateProduct($product,$type='',$show=4,$moreClass=''){
        if($type == '') $type = $product->type;
		$link = ($product->link) ? $product->link : route('frontend.home.page',['type' => $type, 'slug' => $product->slug]);
        $arrStatus = explode(',',$product->status);
        $status = '<div class="icons">';
        if(in_array('new', $arrStatus)){ $status .= '<span class="new">New</span>'; }
        if(in_array('hot', $arrStatus)){ $status .= '<span class="hot">Hot</span>'; }
        if($product->sale_price > 0){ $status .= '<span class="sale">Sale</span>'; }
        $status .= '</div>';
        if($show==6){ $class = "col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-wide"; }
        elseif($show==4){ $class = "col-md-3 col-sm-4 col-xs-6 col-xs-wide"; }
        elseif($show==3){ $class = "col-md-4 col-sm-6 col-xs-6 col-xs-wide"; }
        elseif($show==2){ $class = "col-sm-6 col-xs-6 col-xs-wide"; }
        elseif($show==1){ $class = "col-xs-12"; }
		$template = '
            <div class="'.$class.' '.$moreClass.'">
                <div class="product-item">
                    <div class="image">
                        <a href="'.$link.'"><img src="'. ( $product->image && file_exists(public_path('/uploads/products/'.$product->image)) ? asset( 'public/uploads/products/'.get_thumbnail($product->image, '_medium') ) : asset('noimage/350x350') ) .'" alt="'.$product->alt.'" /></a>
                    </div>
                    <div class="info">
                        <span class="price">
                            '.self::getTemplateProductPrice($product->regular_price, $product->sale_price).'
                        </span>
                        <h2 class="title"><a href="'.$link.'">'.$product->title.'</a></h2>
                    </div>
                    '.$status.'
                    <div class="action">
                        <a href="#" class="btn add-to-wishlist dropdown-toggle tooltips" data-style="default" data-container="body" data-placement="top" data-original-title="Yêu thích" data-ajax="id='. $product->id .'"> <i class="fa fa-heart-o"></i> </a>
                        <a href="#" class="btn dropdown-toggle tooltips add-to-cart" data-style="default" data-container="body" data-placement="top" data-original-title="Giỏ hàng" data-ajax="id='. $product->id .'"> <i class="fa fa-shopping-cart"></i> </a>
                        <a href="#" class="btn dropdown-toggle tooltips" data-style="default" data-container="body" data-placement="top" data-original-title="Xem nhanh" > <i class="fa fa-search"></i> </a>
                    </div>
                    <a href="'.$link.'" class="link"></a>
                </div>
            </div>
		';

		return $template;
	}

    public function getTemplatePost($post,$type='',$show=4,$moreClass=''){
        if($type == '') $type = $post->type;
        $link = ($post->link) ? $post->link : route('frontend.home.page',['type' => $type, 'slug' => $post->slug]);
        if($show==6){ $class = "col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-wide"; }
        elseif($show==4){ $class = "col-md-3 col-sm-4 col-xs-6 col-xs-wide"; }
        elseif($show==3){ $class = "col-md-4 col-sm-6 col-xs-6 col-xs-wide"; }
        elseif($show==2){ $class = "col-sm-6 col-xs-6 col-xs-wide"; }
        elseif($show==1){ $class = "col-xs-12"; }
        $template = '
            <div class="'.$class.' '.$moreClass.'">
                <div class="post-item">
                    <a class="image" href="'.$link.'"><img src="'. ( $post->image && file_exists(public_path('/uploads/posts/'.$post->image)) ? asset( 'public/uploads/posts/'.get_thumbnail($post->image) ) : asset('noimage/330x220') ) .'" alt="'.$post->alt.'" /></a>
                    <div class="desc">
                        <h3 class="title"><a href="'.$link.'">'.$post->title.'</a></h3>
                        <p class="meta"> <span><i class="pe-7s-date"></i> '.date(( config('settings.date_format') == 'custom' ? config('settings.date_custom_format') : config('settings.date_format') ),strtotime($post->updated_at)).'</span> </p>
                        <p>'.substr($post->description,0,100).'</p>
                        <p><a href="'.$link.'">[...]</a></p>
                    </div>
                </div>
            </div>
        ';

        return $template;
    }

    public function getTemplateCollection($post,$type='',$show=4,$moreClass=''){
        if($type == '') $type = $post->type;
        $link = ($post->link) ? $post->link : route('frontend.home.page',['type' => $type, 'slug' => $post->slug]);
        if($show==6){ $class = "col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-wide"; }
        elseif($show==4){ $class = "col-md-3 col-sm-4 col-xs-6 col-xs-wide"; }
        elseif($show==3){ $class = "col-md-4 col-sm-6 col-xs-6 col-xs-wide"; }
        elseif($show==2){ $class = "col-sm-6 col-xs-6 col-xs-wide"; }
        elseif($show==1){ $class = "col-xs-12"; }
        $template = '
            <div class="collection-item '.$class.' '.$moreClass.'">
                <div class="image">
                    <img src="'. ( $post->image && file_exists(public_path('/uploads/posts/'.$post->image)) ? asset( 'public/uploads/posts/'.$post->image ) : asset('noimage/500x500') ) .'" alt="'.$post->alt.'" />
                    <div class="desc">
                        <div>
                            <h3 class="title"><a href="'.$link.'">'.$post->title.'</a></h3>
                            <p class="social">
                                <a href="#" target="_blank"><span class="fa fa-facebook"></span></a>
                                <a href="#" target="_blank"><span class="fa fa-twitter"></span></a>
                                <a href="#" target="_blank"><span class="fa fa-vimeo"></span></a>
                                <a href="#" target="_blank"><span class="fa fa-pinterest"></span></a>
                                <a href="#" target="_blank"><span class="fa fa-google"></span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        ';

        return $template;
    }

    public function getTemplateSinglePost($post,$type='',$show=4,$moreClass=''){
        if($type == '') $type = $post->type;
        $link = ($post->link) ? $post->link : route('frontend.home.page',['type' => $type, 'slug' => $post->slug]);
        if($show==6){ $class = "col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-wide"; }
        elseif($show==4){ $class = "col-md-3 col-sm-4 col-xs-6 col-xs-wide"; }
        elseif($show==3){ $class = "col-md-4 col-sm-6 col-xs-6 col-xs-wide"; }
        elseif($show==2){ $class = "col-sm-6 col-xs-6 col-xs-wide"; }
        elseif($show==1){ $class = "col-xs-12"; }
        $template = '
            <div class="'.$class.' '.$moreClass.'">
                <div class="single-post">
                    <img src="'. ( $post->image && file_exists(public_path('/uploads/posts/'.$post->image)) ? asset( 'public/uploads/posts/'.get_thumbnail($post->image) ) : asset('noimage/330x220') ) .'" alt="'.$post->alt.'" />
                    <h2 class="title">'.$post->title.'</h2>
                    <p>'.substr($post->description,0,100).'</p>
                </div>
            </div>
        ';

        return $template;
    }

    public function getTemplateComment($data,$parent=0,$lvl=0){
        $result = '';
        if( isset($data[$parent]) ){
            if( $parent==0 ){
                $result .= '<div class="timeline comment-list">';
            }else{
                $result .= '<div class="timeline comment-list">';
                krsort($data[$parent]);
            }
            foreach($data[$parent] as $k=>$v){
                $id=$v->id;
                $result .= '<div class="timeline-item">';
                $result .= '
                    <div class="timeline-badge">
                        <div class="timeline-icon">
                            <i class="icon-user"></i>
                        </div>
                        <div class="timeline-badge-name">'.$v->name.'</div>
                        <div class="timeline-badge-time font-grey-cascade">'.Tool::niceTime($v->created_at).'</div>
                    </div>
                    <div class="timeline-wrap">
                        <div class="timeline-body">
                            <div class="timeline-body-arrow"> </div>
                            <div class="timeline-body-head">
                                <div class="timeline-body-head-caption">
                                    '.Tool::buildRating($v->score).'
                                    <span class="timeline-body-title font-blue-madison">'.$v->title.'</span>
                                </div>
                                <div class="timeline-body-head-actions">
                                    '.($lvl < 1 ? '<a href="#" class="btn reply" data-parent="'.$v->id.'" data-product="'.( @$v->product_id ? $v->product_id : '0' ).'" data-post="'.( @$v->post_id ? $v->post_id : '0' ).'">'.__('site.reply').'</a>' : '').'</div>
                            </div>
                            <div class="timeline-body-content">
                                <div class="font-grey-cascade">'.$v->description.'</div>
                            </div>
                            
                        </div>';
                        $result .= self::getTemplateComment($data,$id,$lvl+1);
                $result .= '</div>';
                $result .= '</div>';
            }
            $result .= '</div>';
        }
        return $result;
        $result = '';
        if( isset($data[$parent]) ){
            if( $parent==0 ){
                $result .= '<ul class="comment-list">';
            }else{
                $result .= '<ul>';
                krsort($data[$parent]);
            }
            foreach($data[$parent] as $k=>$v){
                $id=$v->id;
                $result .= '<li>';
                $result .= '
                    <div class="single-comment clearfix" data-lvl="'.$id.'"">
                        <div class="image float-left"><img src="'.asset('noimage/50x50').'" alt="" class="img-circle"></div>
                        <div class="content">
                            <div class="head">
                                <div class="author-time">
                                    <h4>'.$v->name.'</h4>
                                    <span>'.Tool::niceTime($v->created_at).'</span>
                                </div>
                                
                            </div>
                            <p>'.$v->description.'</p>
                        </div>
                    </div>
                ';
                $result .= self::getTemplateComment($data,$id,$lvl+1);
                $result .= '</li>';
            }
            $result .= '</ul>';
        }
        return $result;
    }
}