<?php
	/**
	 * @package YBAPI
	 *
	 * 授权认证接口
	 *
	 * 使用授权认证协议认证方式的接口
	 * 授权接口中的接口对于appid或appsecret还有access_token有不同的需求
	 * 调用不同方法时需要开发人员保证已经把对应的配置值传入
	 */
	class YBAPI_Authorize{
		
		const API_OAUTH_CODE	= "oauth/authorize";
		const API_OAUTH_TOKEN	= "oauth/access_token";
		const API_TOKEN_QUERY	= "oauth/token_info";
		const API_TOKEN_REVOKE	= "oauth/revoke_token";
		
		
		/**
		 * 构造函数
		 *
		 * 使用YBOpenApi里的config数组初始化
		 *
		 * @param Array 配置（对应YBOpenApi里的config数组）
		 */
		public function __construct($config) {
			foreach ($config as $key => $val) {
				$this->$key	= $val;
			}
		}
		
		/**
		 * 设置访问令牌
		 *
		 * @param String 访问令牌
		 * @return YBAPI_Authorize 本身实例
		 */
		public function bind($token) {
			$this->token = $token;
			
			return $this;
		}
		
		/**
		 * 生成授权认证地址
		 *
		 * 客户端重定向到授权地址
		 * 获取授权认证的CODE用于取得访问令牌
		 *
		 * @param	String 防跨站伪造参数
		 * @return	String 授权认证页面地址
		 */
		public function forwardurl($state = 'QUERY') {
			assert(!empty($this->appid),   YBLANG::E_NO_APPID);
			assert(!empty($this->backurl), YBLANG::E_NO_CALLBACKURL);
			
			$query = http_build_query(array(
				'client_id'		=> $this->appid,
				'redirect_uri'	=> $this->backurl,
				'state'			=> $state,
			));
			
			return YBOpenApi::YIBAN_OPEN_URL.self::API_OAUTH_CODE.'?'.$query;
		}
		
		/**
		 * 通过授权的CODE获取访问令牌
		 *
		 * 应用服务器只需要请用此接口
		 * 自动处理重定向
		 *
		 * @param	String 授权CODE
		 * @param	String 应用回调地址
		 * @return	Array  访问令牌哈希数组
		 */
		public function querytoken($code, $redirect_uri = '') {
			assert(!empty($this->appid),   YBLANG::E_NO_APPID);
			assert(!empty($this->seckey),  YBLANG::E_NO_APPSECRET);
			
			if(empty($redirect_uri)) {
				$redirect_uri = $this->backurl;
			}
			$param = array(
				'client_id'		=> $this->appid,
				'client_secret'	=> $this->seckey,
				'code'			=> $code,
				'redirect_uri'	=> $redirect_uri
			);
			
			$info = YBOpenApi::getInstance()->request(self::API_OAUTH_TOKEN, $param, true, false);
			if(isset($info['access_token'])) {
			    $this->bind($info['access_token']);
			}
			return $info;
		}
		
		
		/**
		 * 获取用户token
		 */
		public function getToken(){
		    if(isset($_GET['code']) && !empty($_GET['code'])) {
		        /**
		         * 使用授权码（code）获取访问令牌
		         * 若获取成功，返回 $info['access_token']
		         * 否则查看对应的 msgCN 查看错误信息
		         */
		        $info = $this->querytoken($_GET['code']);
		        if(isset($info['access_token'])) {
		            return array('status'=>true, 'token'=>$info['access_token']);
		        }else {
		            return array('status'=>false, 'msg'=>$info['msgCN']);
		        }
		    }else {	// 重定向到授权服务器（这里使用header()重定向，可用使用其它方法）
		        header('location: '.$this->forwardurl());
		        return array('status'=>false, 'msg'=>'');;
		    }
		}
	}
	
?>