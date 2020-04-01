<?php
namespace Home\Controller;
use Think\Controller;
class ContentController extends BaseController {
	public function index($goodsid){
        $re=M('product')->where("id=$goodsid")->find();
		$productid=$re['id'];
		$image=M('productimage')->where("productid=$productid and imagepath LIKE '%mid%'")->find();
		$first=M('productimage')->where("productid=$productid and imagepath LIKE '%small%'")->limit(0,1)->find();
		$images=M('productimage')->where("productid=$productid and imagepath LIKE '%small%'")->limit(1,8)->select();
		$addr=M('product')->join('inner join place on product.placeid=place.id')->where("product.id=$goodsid")->find();
		$sendtime=$addr['sendtime'];
        $sendtime=substr($sendtime,0,10);
        $addr=$addr['placename'];
		$pinpid=$re['pinpid'];
		$fupinpid=M("brand")->where("id=$pinpid")->find();
		$fupinpid=$fupinpid['pid'];
		$wupin=M("product")->where("id<>$productid")->select();

		foreach($wupin as $k=>$v){
			$pin=$v['pinpid'];

			$fu=M('brand')->where("id=$pin")->find();

			$fu=$fu['pid'];

			if($fu==$fupinpid){
				$wu[$k]=$wupin[$k];
				$wuid=$wu[$k]['id'];
				$img=M("productimage")->where("productid=$wuid")->select();
				$wu[$k]['img']=$img;
			}
		}

		$user=$_SESSION['user'];


		$this->assign('user',$user);
		$this->assign('tuijian',$wu);
		$this->assign('sendtime',$sendtime);
		$this->assign('addr',$addr);
		$this->assign('proinfo',$re);
		$this->assign('images',$images);
		$this->assign('first',$first);
		$this->assign('image',$image);
		$this->display();
	}

	public function ajax(){
		$productid=$_POST['p'];
		$mima=$_POST['m'];

        $userid=$_SESSION['user']['id'];
		$re=M("pay")->where("userid=$userid and pwd=$mima")->find();
		$proinfo=M("product")->where("id=$productid")->find();
		$placeid=$proinfo['placeid'];
		$buyprice=$proinfo['saleprice'];
		$daishouid=$proinfo['daishouid'];

		if($re){

			$data=array(
				'productid'=>"$productid",
				'userid'=>$userid,
				'placeid'=>$placeid,
				'buyprice'=>$buyprice,
				'daishouid'=>$daishouid
			);
		$rst=M("orders")->add($data);

		$rst2=M("daishou")->where("id=$daishouid")->save(array(
			'state'=>'已售出'
		));
			if($rst&&$rst2){
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 3;
		}

	}
}
