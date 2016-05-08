<?php

	include "session.php";

	$level = $dataarray['level'];


		if($level == "1"){
			//level 1 display #teacher
			include "header.php";
			echo '
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><span>Infomatic </span>Admin</a>
						<ul class="user-menu">
							<li class="dropdown pull-right">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> '.$dataarray['username'].'<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="?page=profile"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
									<li><a href="?page=logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
									
				</div><!-- /.container-fluid -->
			</nav>
			<!--sidebar -->

			<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
				<form role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
				</form>
				<ul class="nav menu">
					<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg> Dashboard</a></li>
					<li class="parent ">
						<a href="#">
							<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> News Management 
						</a>
						<ul class="children collapse" id="sub-item-1">
							<li>
								<a class="" href="dashboard.php?page=addnews">
									<svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Add News
								</a>
							</li>
							<li>
								<a class="" href="dashboard.php?page=news">
									<svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> List News
								</a>
							</li>
						</ul>
					</li>

					<li><a href="dashboard.php?page=profile"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
					<li><a href="dashboard.php?page=about"><svg class="glyph stroked monitor"><use xlink:href="#stroked-monitor"></use></svg> About</a></li>

					<li role="presentation" class="divider"></li>
				</ul>

			</div>



			';

			//page section

			if(isset($_GET['page'])){
				if($_GET['page'] == 'logout'){
					session_destroy();
					echo '<script type="text/javascript">window.location.href = "login.php"</script>';

				}

				if($_GET['page'] == 'news' ){

					$newssql = 'SELECT * FROM news WHERE post_by = "'.$dataarray['name'].'" ORDER BY id ASC';
					$query = mysqli_query($dbc, $newssql);
					$newsrows = mysqli_num_rows($query);

					echo '
					<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
						<div class="row">
							<ol class="breadcrumb">
								<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
								<li class="active">News</li>
							</ol>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<h1 class="page-header">News</h1>
							</div>
						</div><!--/.row-->
								
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading">List News</div>
									<div class="panel-body">
										<table data-toggle="table" id="table-style" data-row-style="rowStyle">
										    <thead>
										    <tr>
										        <th data-align="right" >ID</th>
										        <th>Title</th>
										        <th>News</th>
										        <th>Posted By</th>
										        <th>Post Date</th>
										        <th>Published</th>
										        <th colspan=2 >Action</th>
										    </tr>
										    </thead>

										    <tbody>
										    ';


										    if($newsrows > 0){
												while ($newsdata = mysqli_fetch_array($query)) {
													$news = substr($newsdata['news'], 0, 15);
													if($newsdata['enabled'] == '1'){
														$publish = 'Yes';
													}
													else {
														$publish = 'No';
													}
													echo '
														<tr>
															<td>'.$newsdata['id'].'</td>
															<td>'.$newsdata['title'].'</td>
															<td>'.$news.'</td>
															<td>'.$newsdata['post_by'].'</td>
															<td>'.$newsdata['post_date'].'</td>
															<td>'.$publish.'</td>
															<td><a href="?page=newsupdate&id='.$newsdata['id'].'">Update</a></td>
															<td><a href="?page=newsdelete&id='.$newsdata['id'].'">Delete</a></td>
														</tr>		
													';
												}
											}


										    echo '
										    </tbody>
										</table>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

						
					';
				


				}

				if($_GET['page'] == 'addnews'){
					if(isset($_POST['add'])){
						//grab data $_POST
						$title = $_POST['title'];
						$news = $_POST['news'];
						$level = $_POST['level'];

						//sanitize $_POST
						$title = mysqli_real_escape_string($dbc, $title);
						$news = mysqli_real_escape_string($dbc, $news);
						$level = mysqli_real_escape_string($dbc, $level);

						$date = date("Y-m-d");
						$user = $dataarray['name'];

						$addsql = 'INSERT INTO news (title, news, level, post_by, post_date, enabled) VALUES ("'.$title.'", "'.$news.'", "'.$level.'", "'.$user.'", "'.$date.'", "0")';

						$query = mysqli_query($dbc, $addsql);

						if(!$query){
								echo '<script type="text/javascript">alert("Fail to add news");window.location.href = "dashboard.php?page=news"</script>';
								
							}
							else {

								echo '<script type="text/javascript">alert("News added successfully");window.location.href = "dashboard.php?page=news";</script>';
								
							}
						}

					echo '
					<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
									<div class="row">
										<ol class="breadcrumb">
											<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
											<li class="active">Add News</li>
										</ol>
									</div><!--/.row-->
									
									<div class="row">
										<div class="col-lg-12">
											<h1 class="page-header">Add News</h1>
										</div>
									</div><!--/.row-->
											
									
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading">Add News</div>
												<div class="panel-body">
													<div class="col-md-6">
														<form role="form" action="" method="POST">
														
															<div class="form-group">
																<label>Title</label>
																<input class="form-control" name="title" value="" >
															</div>


															<div class="form-group">
																<label>News</label>
																<textarea class="form-control" rows="4" name="news"></textarea>
															</div>
																							

															<!--
															<div class="form-group">
																<label>File input</label>
																<input type="file">
																 <p class="help-block">Example block-level help text here.</p>
															</div>
															-->

															
															
														</div>
														<div class="col-md-6">
														
															<div class="form-group">
																<label>Priority</label>
																<select class="form-control" name="level">
																	<option value="3" >Urgent</option>
																	<option value="2" >Medium</option>
																	<option value="1" >Low</option>
																</select>
															</div>
															
															<button type="submit" class="btn btn-primary" name="add">Add News</button>
															<button type="reset" class="btn btn-default">Reset</button>
														</div>
													</form>
												</div>
											</div>
										</div><!-- /.col-->
									</div><!-- /.row -->
									
								</div>
					';
				}

				if($_GET['page'] == 'newsupdate'){

					if(isset($_GET['id'])){
						$id = $_GET['id'];
						$id = mysqli_real_escape_string($dbc, $id);
						$updatefetchsql = "SELECT * FROM news WHERE id = '".$id."'";
						$query = mysqli_query($dbc, $updatefetchsql);
						$arraydata = mysqli_fetch_array($query);
						$rows = mysqli_num_rows($query);

						//selected
						$opt1 = '';
						$opt2 = '';
						$opt3 = '';

						
						if($arraydata['level'] == '1'){
							$opt1 = 'selected';
						}
						elseif($arraydata['level'] == '2'){
							$opt2 = 'selected';
						}
						else {
							$opt3 = 'selected';
						}

						if(isset($_POST['update'])){
							//grab data $_POST
							$title = $_POST['title'];
							$news = $_POST['news'];
							$level = $_POST['level'];

							//sanitize $_POST
							$title = mysqli_real_escape_string($dbc, $title);
							$news = mysqli_real_escape_string($dbc, $news);
							$level = mysqli_real_escape_string($dbc, $level);

							$updatesql = "UPDATE news SET title = '".$title."', news = '".$news."', level = '".$level."' WHERE id = '".$id."'";
							
							$query = mysqli_query($dbc, $updatesql);

							if(!$query){
								echo '<script type="text/javascript">alert("Fail to update news");window.location.href = "dashboard.php?page=newsupdate&id='.$id.'"</script>';
								
							}
							else {

								echo '<script type="text/javascript">alert("News updated successfully");window.location.href = "dashboard.php?page=news";</script>';
								
							}
						}
							
						elseif($rows > 0) {

							echo '
								<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
									<div class="row">
										<ol class="breadcrumb">
											<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
											<li><a href="dashboard.php?page=news">News</a></li>
											<li class="active">Update News</li>
										</ol>
									</div><!--/.row-->
									
									<div class="row">
										<div class="col-lg-12">
											<h1 class="page-header">Update News </h1>
										</div>
									</div><!--/.row-->
											
									
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading">Update News :: '.$arraydata['title'].'</div>
												<div class="panel-body">
													<div class="col-md-6">
														<form role="form" action="" method="POST">
														
															<div class="form-group">
																<label>Title</label>
																<input class="form-control" name="title" value="'.$arraydata['title'].'" >
															</div>


															<div class="form-group">
																<label>News</label>
																<textarea class="form-control" rows="4" name="news">'.$arraydata['news'].'</textarea>
															</div>
										

															<!--
															<div class="form-group">
																<label>File input</label>
																<input type="file">
																 <p class="help-block">Example block-level help text here.</p>
															</div>
															-->

															
															
														</div>
														<div class="col-md-6">
														
															<div class="form-group">
																<label>Priority</label>
																<select class="form-control" name="level">
																	<option value="3" '.$opt3.'>Urgent</option>
																	<option value="2" '.$opt2.'>Medium</option>
																	<option value="1" '.$opt1.'>Low</option>
																</select>
															</div>
															
															<button type="submit" class="btn btn-primary" name="update">Update News</button>
															<button type="reset" class="btn btn-default">Reset</button>
														</div>
													</form>
												</div>
											</div>
										</div><!-- /.col-->
									</div><!-- /.row -->
									
								</div>
							';
						}
						else {
							echo 'Application Error';
						}

					}
				}
				if($_GET['page'] == 'about'){
					echo '
					<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
						<div class="row">
							<ol class="breadcrumb">
								<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
							<li class="active">About</li>
							</ol>
						</div><!--/.row-->

						<div class="row">
							<div class="col-lg-12">
								<h1 class="page-header">About Infomatic Board System</h1>
							</div>
						</div>
									
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-info">
									<div class="panel-heading">
										About
									</div>
									<div class="panel-body">
										<a class="navbar-brand" href="https://github.com/mzulfahmy"><span>Infomatic </span>Board System</a>
										<p>Infomatic Board system was build for Project Based Education by Mohamad Zulfahmy for Kolej Vokasional Shah Alam.</p>
										<p>Current build for this system is <b>v1.03 BETA</b></p>
										<br>

										<p>Feel free to contact me via Facebook @ <a href="https://fb.me/bforcex">https://fb.me/bforcex</a> <br> Project open-sourced at Github @ <a href="https://github.com/mzulfahmy">https://github.com/mzulfahmy</a></p>
										<div class="col-md-6">
    										<img src="images/logo.png">
  										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-info">
									<div class="panel-heading">
										System Changelog
									</div>
									<div class="panel-body">
										<b>V1.1 BETA (NEXT RELEASE)</b>
										<ol>
												<ul>	
													<li>Image on news</li>
													<li>User profile picture</li>
													<li>Search box</li>
												</ul>
										</ol>
										<b>V1.03 BETA (CURRENT)</b>
										<ol>
												<ul>	
													<li>User management</li>
													<li>Fixed SQL injection</li>
													<li>Improved system stability</li>
												</ul>
										</ol>
										<b>V1.02 BETA</b>
										<ol>
												<ul>
													<li>Setting page</li>
													<li>2 Level admin access</li>
												</ul>
										</ol>
										<b>V1.01 BETA</b>
										<ol>
												<ul>
													<li>Improved security</li>
													<li>Profile management</li>
													<li>Improved news management</li>
													<li>Database tuning</li>
												</ul>
										</ol>

										<b>V1.0 BETA</b>
										<ol>
											<li>First release
												<ul>
													<li>Dynamic news management</li>
													<li>Responsive web design</li>
													<li>User management</li>
												</ul>
											</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
					';
				}

				if($_GET['page'] == 'newsdelete'){
						if(isset($_GET['id'])){
							$id = $_GET['id'];
							$id = mysqli_real_escape_string($dbc, $id);

							$deletesql = "DELETE FROM news WHERE id = '".$id."'";

							$query = mysqli_query($dbc, $deletesql);

							if(!$query){
								echo '<script type="text/javascript">alert("Fail to delete news");window.location.href = "dashboard.php?page=news</script>';
								
							}
							else {

								echo '<script type="text/javascript">alert("News deleted successfully");window.location.href = "dashboard.php?page=news";</script>';
								
							}
						}
					}

					if($_GET['page'] == 'profile'){
						$id = $dataarray['id'];
						$id = mysqli_real_escape_string($dbc, $id);

						$opt1 = '';
						$opt2 = '';

						$sqlfetchuser = "SELECT * FROM user WHERE id = '".$id."'";

						$query = mysqli_query($dbc, $sqlfetchuser);
						$rows = mysqli_num_rows($query);
						$userarray = mysqli_fetch_array($query);

							if($rows >0 ){


								if($userarray['level'] == '1'){
									$opt1 = 'selected';
								}
								else{
									$opt2 = 'selected';
								}

								if(isset($_POST['update'])){
									//update user bah
									$username = $_POST['username'];
									$name = $_POST['name'];
									$email = $_POST['email'];
									$password = $_POST['password'];

									if(empty($password)){
										$password = $userarray['password'];
									}
									else {
									//encrypt password
										$password = md5($password);
									}

									//sanitize input

									$username = mysqli_real_escape_string($dbc, $username);
									$name = mysqli_real_escape_string($dbc, $name);
									$email = mysqli_real_escape_string($dbc, $email);
									$password = mysqli_real_escape_string($dbc, $password);
									

									//sql 
									$sqlupdateuser = "UPDATE user SET name = '".$name."', username = '".$username."', password = '".$password."', email = '".$email."' WHERE id = '".$id."'";
									
									$query = mysqli_query($dbc, $sqlupdateuser);

									if(!$query){
										echo '<script type="text/javascript">alert("Fail to update user");window.location.href = "dashboard.php?page=preuser</script>';
										
									}
									else {

										echo '<script type="text/javascript">alert("User updated successfully");window.location.href = "dashboard.php?page=preuser";</script>';
										
									}

									
								}

									echo '
										<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
											<div class="row">
												<ol class="breadcrumb">
													<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
													<li class="active">Profile</li>
												</ol>
											</div><!--/.row-->
											
											<div class="row">
												<div class="col-lg-12">
													<h1 class="page-header">Edit Profile </h1>
												</div>
											</div><!--/.row-->
													
											
											<div class="row">
												<div class="col-lg-12">
													<div class="panel panel-default">
														<div class="panel-heading">Edit Profile :: '.$userarray['name'].'</div>
														<div class="panel-body">
															<div class="col-md-6">
																<form role="form" action="" method="POST">
																

																	<div class="form-group">
																		<label>Name</label>
																		<input class="form-control" name="name" value="'.$userarray['name'].'" >
																	</div>

																	<div class="form-group">
																		<label>Username</label>
																		<input class="form-control" name="username" value="'.$userarray['username'].'" >
																	</div>

																	<div class="form-group">
																		<label>Password</label>
																		<input type="password" name="password" class="form-control" >
																	</div>

																	<div class="form-group">
																		<label>Email</label>
																		<input class="form-control" name="email" value="'.$userarray['email'].'" >
																	</div>
																						

																	<!--
																	<div class="form-group">
																		<label>File input</label>
																		<input type="file">
																		 <p class="help-block">Example block-level help text here.</p>
																	</div>
																	-->

																	<button type="submit" class="btn btn-primary" name="update">Save</button>
																	<button type="reset" class="btn btn-default">Reset</button>
																	
																</div>
															</form>
														</div>
													</div>
												</div><!-- /.col-->
											</div><!-- /.row -->
											
										</div>';

								}

					}



			}
			else {
				if(isset($_POST['add'])){
					//grab data $_POST
					$title = $_POST['title'];
					$news = $_POST['news'];
					$level = $_POST['level'];
					//sanitize $_POST
					$title = mysqli_real_escape_string($dbc, $title);
					$news = mysqli_real_escape_string($dbc, $news);
					$level = mysqli_real_escape_string($dbc, $level);

					$date = date("Y-m-d");
					$user = $dataarray['name'];

					$addsql = 'INSERT INTO news (title, news, level, post_by, post_date, enabled) VALUES ("'.$title.'", "'.$news.'", "'.$level.'", "'.$user.'", "'.$date.'", "0")';

					$query = mysqli_query($dbc, $addsql);

					if(!$query){
						echo '<script type="text/javascript">alert("Fail to add news");window.location.href = "dashboard.php?page=news"</script>';
									
					}
					else {

						echo '<script type="text/javascript">alert("News added successfully");window.location.href = "dashboard.php?page=news";</script>';
									
					}
				}

				$countpost = "SELECT COUNT(*) as totalpost FROM news WHERE post_by = '".$dataarray['name']."'";
				$queryp = mysqli_query($dbc, $countpost);
				$arraypost = mysqli_fetch_array($queryp);

				$countpost1 = "SELECT COUNT(*) as approved FROM news WHERE enabled='1' AND post_by = '".$dataarray['name']."'";
				$queryp1 = mysqli_query($dbc, $countpost1);
				$arraypost1 = mysqli_fetch_array($queryp1);

				$countpost2 = "SELECT COUNT(*) as unapproved FROM news WHERE enabled='0' AND post_by = '".$dataarray['name']."'";
				$queryp2 = mysqli_query($dbc, $countpost2);
				$arraypost2 = mysqli_fetch_array($queryp2);

				echo '
				<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
							<div class="row">
								<ol class="breadcrumb">
									<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
								</ol>
							</div>
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Dashboard</h1>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-3">
					<div class="panel panel-orange panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large">'.$arraypost['totalpost'].'</div>
								<div class="text-muted">Total Post</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-3">
					<div class="panel panel-blue panel-widget ">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large">'.$arraypost1['approved'].'</div>
								<div class="text-muted">Approved Post</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-3">
					<div class="panel panel-red panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large">'.$arraypost2['unapproved'].'</div>
								<div class="text-muted">Unapproved Post</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">Quick News</div>
							<div class="panel-body">
								<div class="col-md-6">
									<form role="form" action="" method="POST">
															
										<div class="form-group">
											<label>Title</label>
											<input class="form-control" name="title" value="" >
										</div>


										<div class="form-group">
											<label>News</label>
											<textarea class="form-control" rows="4" name="news"></textarea>
										</div>
																																																
									</div>
										<div class="col-md-6">
															
										<div class="form-group">
											<label>Priority</label>
											<select class="form-control" name="level">
												<option value="3" >Urgent</option>
												<option value="2" >Medium</option>
												<option value="1" >Low</option>
											</select>
										</div>
																
											<button type="submit" class="btn btn-primary" name="add">Add News</button>
											<button type="reset" class="btn btn-default">Reset</button>
									</div>
								</form>
							</div>
						</div>
					</div><!-- /.col-->
				</div><!-- /.row -->
										

				</div>


				';
			}

			include "footer.php";

		}
		elseif ($level == "2"){
			//level 2 display #admin
			include "header.php";

			echo '
				<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#"><span>Infomatic </span>Admin</a>
							<ul class="user-menu">
								<li class="dropdown pull-right">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> '.$dataarray['username'].' <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="?page=profile"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
										<li><a href="?page=settings"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
										<li><a href="?page=logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
									</ul>
								</li>
							</ul>
						</div>
										
					</div><!-- /.container-fluid -->
				</nav>

					<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
				<form role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
				</form>
				<ul class="nav menu">
					<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg> Dashboard</a></li>
					<li class="parent ">
						<a href="#">
							<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> News Management 
						</a>
						<ul class="children collapse" id="sub-item-1">
							<li>
								<a class="" href="dashboard.php?page=addnews">
									<svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Add News
								</a>
							</li>
							<li>
								<a class="" href="dashboard.php?page=appnews">
									<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Approve News
								</a>
							</li>
							<li>
								<a class="" href="dashboard.php?page=news">
									<svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> List News
								</a>
							</li>
						</ul>
					</li>

					<li class="parent ">
						<a href="#">
							<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> User
						</a>
						<ul class="children collapse" id="sub-item-2">
							<li>
								<a class="" href="dashboard.php?page=adduser">
									<svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Add User
								</a>
							</li>
							<li>
								<a class="" href="dashboard.php?page=preuser">
									<svg class="glyph stroked notepad"><use xlink:href="#stroked-notepad"></use></svg> List User
								</a>
							</li>
							<li>
								<a class="" href="dashboard.php?page=profile">
									<svg class="glyph stroked male user"><use xlink:href="#stroked-male-user"></use></svg> Profile
								</a>
							</li>
						</ul>
					</li>

					<li><a href="dashboard.php?page=settings"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
					<li><a href="dashboard.php?page=about"><svg class="glyph stroked monitor"><use xlink:href="#stroked-monitor"></use></svg> About</a></li>

					<li role="presentation" class="divider"></li>
				</ul>

			</div>

			';

			if(isset($_GET['page'])){
				if($_GET['page'] == 'logout'){
					session_destroy();
					echo '<script type="text/javascript">window.location.href = "login.php"</script>';

				}

				if($_GET['page'] == 'news' ){

					$newssql = 'SELECT * FROM news ORDER BY id ASC';
					$query = mysqli_query($dbc, $newssql);
					$newsrows = mysqli_num_rows($query);

					echo '
					<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
						<div class="row">
							<ol class="breadcrumb">
								<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
								<li class="active">News</li>
							</ol>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<h1 class="page-header">News</h1>
							</div>
						</div><!--/.row-->
								
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading">List News</div>
									<div class="panel-body">
										<table data-toggle="table" id="table-style" data-row-style="rowStyle">
										    <thead>
										    <tr>
										        <th data-align="right" >ID</th>
										        <th>Title</th>
										        <th>News</th>
										        <th>Posted By</th>
										        <th>Post Date</th>
										        <th>Published</th>
										        <th colspan=2 >Action</th>
										    </tr>
										    </thead>

										    <tbody>
										    ';


										    if($newsrows > 0){
												while ($newsdata = mysqli_fetch_array($query)) {
													$news = substr($newsdata['news'], 0, 15);
													if($newsdata['enabled'] == '1'){
														$publish = 'Yes';
													}
													else {
														$publish = 'No';
													}
													echo '
														<tr>
															<td>'.$newsdata['id'].'</td>
															<td>'.$newsdata['title'].'</td>
															<td>'.$news.'</td>
															<td>'.$newsdata['post_by'].'</td>
															<td>'.$newsdata['post_date'].'</td>
															<td>'.$publish.'</td>
															<td><a href="?page=newsupdate&id='.$newsdata['id'].'">Update</a></td>
															<td><a href="?page=newsdelete&id='.$newsdata['id'].'">Delete</a></td>
														</tr>		
													';
												}
											}


										    echo '
										    </tbody>
										</table>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

						
					';
				


				}

				if($_GET['page'] == 'appnews'){

					$newssql = 'SELECT * FROM news WHERE enabled = "0" ORDER BY id ASC';
					$query = mysqli_query($dbc, $newssql);
					$newsrows = mysqli_num_rows($query);

					echo '
					<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
						<div class="row">
							<ol class="breadcrumb">
								<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
								<li class="active">Approve News</li>
							</ol>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<h1 class="page-header">Approve News</h1>
							</div>
						</div><!--/.row-->
								
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading">List News</div>
									<div class="panel-body">
										<table data-toggle="table" id="table-style" data-row-style="rowStyle">
										    <thead>
										    <tr>
										        <th data-align="right" >ID</th>
										        <th>Title</th>
										        <th>News</th>
										        <th>Posted By</th>
										        <th>Post Date</th>
										        <th>Published</th>
										        <th colspan=2 >Action</th>
										    </tr>
										    </thead>

										    <tbody>
										    ';


										    if($newsrows > 0){
												while ($newsdata = mysqli_fetch_array($query)) {
													$news = substr($newsdata['news'], 0, 15);
													if($newsdata['enabled'] == '1'){
														$publish = 'Yes';
													}
													else {
														$publish = 'No';
													}
													echo '
														<tr>
															<td>'.$newsdata['id'].'</td>
															<td>'.$newsdata['title'].'</td>
															<td>'.$news.'</td>
															<td>'.$newsdata['post_by'].'</td>
															<td>'.$newsdata['post_date'].'</td>
															<td>'.$publish.'</td>
															<td><a href="?page=newsupdate&id='.$newsdata['id'].'">Update</a></td>
															<td><a href="?page=newsdelete&id='.$newsdata['id'].'">Delete</a></td>
														</tr>		
													';
												}
											}


										    echo '
										    </tbody>
										</table>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

						
					';

				}

				if($_GET['page'] == 'addnews'){
					if(isset($_POST['add'])){
						//grab data $_POST
						$title = $_POST['title'];
						$news = $_POST['news'];
						$level = $_POST['level'];
						$enabled = (isset($_POST['enabled'])) ? 1 : 0;

						//sanitize $_POST
						$title = mysqli_real_escape_string($dbc, $title);
						$news = mysqli_real_escape_string($dbc, $news);
						$level = mysqli_real_escape_string($dbc, $level);
						$enabled = mysqli_real_escape_string($dbc, $enabled);

						$date = date("Y-m-d");
						$user = $dataarray['name'];

						$addsql = 'INSERT INTO news (title, news, level, post_by, post_date, enabled) VALUES ("'.$title.'", "'.$news.'", "'.$level.'", "'.$user.'", "'.$date.'", "'.$enabled.'")';

						$query = mysqli_query($dbc, $addsql);

						if(!$query){
								echo '<script type="text/javascript">alert("Fail to add news");window.location.href = "dashboard.php?page=news"</script>';
								
							}
							else {

								echo '<script type="text/javascript">alert("News added successfully");window.location.href = "dashboard.php?page=news";</script>';
								
							}
						}

					echo '
					<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
									<div class="row">
										<ol class="breadcrumb">
											<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
											<li class="active">Add News</li>
										</ol>
									</div><!--/.row-->
									
									<div class="row">
										<div class="col-lg-12">
											<h1 class="page-header">Add News</h1>
										</div>
									</div><!--/.row-->
											
									
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading">Add News</div>
												<div class="panel-body">
													<div class="col-md-6">
														<form role="form" action="" method="POST">
														
															<div class="form-group">
																<label>Title</label>
																<input class="form-control" name="title" value="" >
															</div>


															<div class="form-group">
																<label>News</label>
																<textarea class="form-control" rows="4" name="news"></textarea>
															</div>
																							
															
															<div class="form-group checkbox">
															  <label>
															    <input type="checkbox" name="enabled" >Published</label>
															</div>

															<!--
															<div class="form-group">
																<label>File input</label>
																<input type="file">
																 <p class="help-block">Example block-level help text here.</p>
															</div>
															-->

															
															
														</div>
														<div class="col-md-6">
														
															<div class="form-group">
																<label>Priority</label>
																<select class="form-control" name="level">
																	<option value="3" >Urgent</option>
																	<option value="2" >Medium</option>
																	<option value="1" >Low</option>
																</select>
															</div>
															
															<button type="submit" class="btn btn-primary" name="add">Add News</button>
															<button type="reset" class="btn btn-default">Reset</button>
														</div>
													</form>
												</div>
											</div>
										</div><!-- /.col-->
									</div><!-- /.row -->
									
								</div>
					';
				}

				if($_GET['page'] == 'newsupdate'){

					if(isset($_GET['id'])){
						$id = $_GET['id'];
						$id = mysqli_real_escape_string($dbc, $id);
						$updatefetchsql = "SELECT * FROM news WHERE id = '".$id."'";
						$query = mysqli_query($dbc, $updatefetchsql);
						$arraydata = mysqli_fetch_array($query);
						$rows = mysqli_num_rows($query);

						//selected
						$opt1 = '';
						$opt2 = '';
						$opt3 = '';

						if($arraydata['enabled'] == '1'){
							$checked = 'checked';

						}
						else {
							$checked = '';

						}
						
						if($arraydata['level'] == '1'){
							$opt1 = 'selected';
						}
						elseif($arraydata['level'] == '2'){
							$opt2 = 'selected';
						}
						else {
							$opt3 = 'selected';
						}

						if(isset($_POST['update'])){
							//grab data $_POST
							$title = $_POST['title'];
							$news = $_POST['news'];
							$level = $_POST['level'];
							$enabled = (isset($_POST['enabled'])) ? 1 : 0;

							//sanitize $_POST
							$title = mysqli_real_escape_string($dbc, $title);
							$news = mysqli_real_escape_string($dbc, $news);
							$level = mysqli_real_escape_string($dbc, $level);
							$enabled = mysqli_real_escape_string($dbc, $enabled);

							$updatesql = "UPDATE news SET title = '".$title."', news = '".$news."', level = '".$level."', enabled = '".$enabled."' WHERE id = '".$id."'";
							
							$query = mysqli_query($dbc, $updatesql);

							if(!$query){
								echo '<script type="text/javascript">alert("Fail to update news");window.location.href = "dashboard.php?page=newsupdate&id='.$id.'"</script>';
								
							}
							else {

								echo '<script type="text/javascript">alert("News updated successfully");window.location.href = "dashboard.php?page=news";</script>';
								
							}
						}
							
						elseif($rows > 0) {

							echo '
								<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
									<div class="row">
										<ol class="breadcrumb">
											<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
											<li><a href="dashboard.php?page=news">News</a></li>
											<li class="active">Update News</li>
										</ol>
									</div><!--/.row-->
									
									<div class="row">
										<div class="col-lg-12">
											<h1 class="page-header">Update News </h1>
										</div>
									</div><!--/.row-->
											
									
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading">Update News :: '.$arraydata['title'].'</div>
												<div class="panel-body">
													<div class="col-md-6">
														<form role="form" action="" method="POST">
														
															<div class="form-group">
																<label>Title</label>
																<input class="form-control" name="title" value="'.$arraydata['title'].'" >
															</div>


															<div class="form-group">
																<label>News</label>
																<textarea class="form-control" rows="4" name="news">'.$arraydata['news'].'</textarea>
															</div>
																							
															
															<div class="form-group checkbox">
															  <label>
															    <input type="checkbox" name="enabled" '.$checked.'>Published</label>
															</div>

															<!--
															<div class="form-group">
																<label>File input</label>
																<input type="file">
																 <p class="help-block">Example block-level help text here.</p>
															</div>
															-->

															
															
														</div>
														<div class="col-md-6">
														
															<div class="form-group">
																<label>Priority</label>
																<select class="form-control" name="level">
																	<option value="3" '.$opt3.'>Urgent</option>
																	<option value="2" '.$opt2.'>Medium</option>
																	<option value="1" '.$opt1.'>Low</option>
																</select>
															</div>
															
															<button type="submit" class="btn btn-primary" name="update">Update News</button>
															<button type="reset" class="btn btn-default">Reset</button>
														</div>
													</form>
												</div>
											</div>
										</div><!-- /.col-->
									</div><!-- /.row -->
									
								</div>
							';
						}
						else {
							echo 'Application Error';
						}

					}
				}

					if($_GET['page'] == 'newsdelete'){
						if(isset($_GET['id'])){
							$id = $_GET['id'];
							$id = mysqli_real_escape_string($dbc, $id);

							$deletesql = "DELETE FROM news WHERE id = '".$id."'";

							$query = mysqli_query($dbc, $deletesql);

							if(!$query){
								echo '<script type="text/javascript">alert("Fail to delete news");window.location.href = "dashboard.php?page=news</script>';
								
							}
							else {

								echo '<script type="text/javascript">alert("News deleted successfully");window.location.href = "dashboard.php?page=news";</script>';
								
							}
						}
					}

				if($_GET['page'] == 'adduser'){
					if(isset($_POST['add'])){
						//grab data $_POST
						$username = $_POST['username'];
						$password = $_POST['password'];
						$name = $_POST['name'];
						$email = $_POST['email'];
						$level = $_POST['level'];
						$enabled = (isset($_POST['enabled'])) ? 1 : 0;

						//sanitize $_POST
						$username = mysqli_real_escape_string($dbc, $username);
						$password = mysqli_real_escape_string($dbc, $password);
						$name = mysqli_real_escape_string($dbc, $name);
						$email = mysqli_real_escape_string($dbc, $email);
						$level = mysqli_real_escape_string($dbc, $level);
						$enabled = mysqli_real_escape_string($dbc, $enabled);

						//add md5 encryption
						$password = md5($password);

						$addsql = 'INSERT INTO user (name, username, password, email, level, enabled) VALUES ("'.$name.'", "'.$username.'", "'.$password.'", "'.$email.'", "'.$level.'", "'.$enabled.'")';

						$query = mysqli_query($dbc, $addsql);

						if(!$query){
								echo '<script type="text/javascript">alert("Fail to add user");window.location.href = "dashboard.php?page=adduser"</script>';
								
							}
							else {

								echo '<script type="text/javascript">alert("User added successfully");window.location.href = "dashboard.php?page=preuser";</script>';
								
							}
						}

					echo '
					<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
									<div class="row">
										<ol class="breadcrumb">
											<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
											<li class="active">Add User</li>
										</ol>
									</div><!--/.row-->
									
									<div class="row">
										<div class="col-lg-12">
											<h1 class="page-header">Add User</h1>
										</div>
									</div><!--/.row-->
											
									
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading">Add User</div>
												<div class="panel-body">
													<div class="col-md-6">
														<form role="form" action="" method="POST">
														
															<div class="form-group">
																<label>Username</label>
																<input class="form-control" name="username" value="" >
															</div>


															<div class="form-group">
																<label>Password</label>
																<input class="form-control" type="password" name="password">
															</div>


															<div class="form-group">
																<label>Name</label>
																<input class="form-control" name="name">
															</div>


															<div class="form-group">
																<label>Email</label>
																<input class="form-control" name="email">
															</div>
																							
															
															<div class="form-group">
																<label>Access</label>
																<select class="form-control" name="level">
																	<option value="2" >Admin</option>
																	<option value="1" >User</option>
																</select>
															</div>


															<div class="form-group checkbox">
															  <label>
															    <input type="checkbox" name="enabled" >Enable</label>
															</div>

															
															<button type="submit" class="btn btn-primary" name="add">Add News</button>
															<button type="reset" class="btn btn-default">Reset</button>

															<!--
															<div class="form-group">
																<label>File input</label>
																<input type="file">
																 <p class="help-block">Example block-level help text here.</p>
															</div>
															-->

															
															
														</div>		
														
													</form>
												</div>
											</div>
										</div><!-- /.col-->
									</div><!-- /.row -->
									
								</div>
					';

				}	

				if($_GET['page'] == 'preuser'){
					$usersql = 'SELECT * FROM user ORDER BY id ASC';
					$query = mysqli_query($dbc, $usersql);
					$userrows = mysqli_num_rows($query);

					echo '
					<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
						<div class="row">
							<ol class="breadcrumb">
								<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
								<li class="active">List User</li>
							</ol>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<h1 class="page-header">List User</h1>
							</div>
						</div><!--/.row-->
								
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading">List User</div>
									<div class="panel-body">
										<table data-toggle="table" id="table-style" data-row-style="rowStyle">
										    <thead>
										    <tr>
										        <th data-align="right" >ID</th>
										        <th>Name</th>
										        <th>Username</th>
										        <th>Email</th>
										        <th>Enabled</th>
										        <th colspan=2 >Action</th>
										    </tr>
										    </thead>

										    <tbody>
										    ';


										    if($userrows > 0){
												while ($userdata = mysqli_fetch_array($query)) {
													if($userdata['enabled'] == '1'){
														$datax = "Yes";
													}
													else {
														$datax = "No";
													}
													echo '
														<tr>
															<td>'.$userdata['id'].'</td>
															<td>'.$userdata['name'].'</td>
															<td>'.$userdata['username'].'</td>
															<td>'.$userdata['email'].'</td>
															<td>'.$datax.'</td>
															<td><a href="?page=profile&id='.$userdata['id'].'">Update</a></td>
															<td><a href="?page=deluser&id='.$userdata['id'].'">Delete</a></td>
														</tr>		
													';
												}
											}


										    echo '
										    </tbody>
										</table>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

						
					';

				}	

				if($_GET['page'] == 'profile'){
					if (isset($_GET['id'])){
						if ($dataarray['level'] == "2"){
							$id = $_GET['id'];
							$id = mysqli_real_escape_string($dbc, $id);

							$opt1 = '';
							$opt2 = '';

							$sqlfetchuser = "SELECT * FROM user WHERE id = '".$id."'";

							$query = mysqli_query($dbc, $sqlfetchuser);
							$rows = mysqli_num_rows($query);
							$userarray = mysqli_fetch_array($query);

							if($userarray['enabled'] == '1'){
							$checked = 'checked';

							}
							else {
								$checked = '';

							}

							if($userarray['level'] == '1'){
								$opt1 = 'selected';
							}
							else{
								$opt2 = 'selected';
							}

							if(isset($_POST['update'])){
								//update user bah
								$username = $_POST['username'];
								$name = $_POST['name'];
								$email = $_POST['email'];
								$enabled = (isset($_POST['enabled'])) ? 1 : 0;
								$access  = $_POST['level'];
								$password = $_POST['password'];

								if(empty($password)){
									$password = $userarray['password'];
								}
								else {
								//encrypt password
									$password = md5($password);
								}

								//sanitize input

								$username = mysqli_real_escape_string($dbc, $username);
								$name = mysqli_real_escape_string($dbc, $name);
								$email = mysqli_real_escape_string($dbc, $email);
								$enabled = mysqli_real_escape_string($dbc, $enabled);
								$access = mysqli_real_escape_string($dbc, $access);
								$password = mysqli_real_escape_string($dbc, $password);
								

								//sql 
								$sqlupdateuser = "UPDATE user SET name = '".$name."', username = '".$username."', password = '".$password."', email = '".$email."', level = '".$access."', enabled = '".$enabled."' WHERE id = '".$id."'";
								
								$query = mysqli_query($dbc, $sqlupdateuser);

								if(!$query){
									echo '<script type="text/javascript">alert("Fail to update user");window.location.href = "dashboard.php?page=preuser</script>';
									
								}
								else {

									echo '<script type="text/javascript">alert("User updated successfully");window.location.href = "dashboard.php?page=preuser";</script>';
									
								}


							}
							elseif ($rows > 0){
								echo '
								<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
									<div class="row">
										<ol class="breadcrumb">
											<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
											<li><a href="dashboard.php?page=profile">Profile</a></li>
											<li class="active">Edit User</li>
										</ol>
									</div><!--/.row-->
									
									<div class="row">
										<div class="col-lg-12">
											<h1 class="page-header">Edit User </h1>
										</div>
									</div><!--/.row-->
											
									
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading">Edit User :: '.$userarray['name'].'</div>
												<div class="panel-body">
													<div class="col-md-6">
														<form role="form" action="" method="POST">
														

															<div class="form-group">
																<label>Name</label>
																<input class="form-control" name="name" value="'.$userarray['name'].'" >
															</div>

															<div class="form-group">
																<label>Username</label>
																<input class="form-control" name="username" value="'.$userarray['username'].'" >
															</div>

															<div class="form-group">
																<label>Password</label>
																<input type="password" name="password" class="form-control" >
															</div>

															<div class="form-group">
																<label>Email</label>
																<input class="form-control" name="email" value="'.$userarray['email'].'" >
															</div>
															
															<div class="form-group">
																<label>Access</label>
																<select class="form-control" name="level">
																	<option value="2" '.$opt2.'>Admin</option>
																	<option value="1" '.$opt1.'>User</option>

																</select>
															</div>						
															
															<div class="form-group checkbox">
															  <label>
															    <input type="checkbox" name="enabled" '.$checked.'>Enabled</label>
															</div>

															<!--
															<div class="form-group">
																<label>File input</label>
																<input type="file">
																 <p class="help-block">Example block-level help text here.</p>
															</div>
															-->

															<button type="submit" class="btn btn-primary" name="update">Save</button>
															<button type="reset" class="btn btn-default">Reset</button>
															
														</div>
													</form>
												</div>
											</div>
										</div><!-- /.col-->
									</div><!-- /.row -->
									
								</div>';

							}
							else {
								echo 'Application error';
							}

						}
						else {
							echo '<script type="text/javascript">alert("Invalid Access");window.location.href = "dashboard.php?page=profile";</script>';
						}
					}
					else {
					//?page=profile here
						$id = $dataarray['id'];
						$id = mysqli_real_escape_string($dbc, $id);

						$opt1 = '';
						$opt2 = '';

						$sqlfetchuser = "SELECT * FROM user WHERE id = '".$id."'";

						$query = mysqli_query($dbc, $sqlfetchuser);
						$rows = mysqli_num_rows($query);
						$userarray = mysqli_fetch_array($query);

							if($rows >0 ){

								if($userarray['enabled'] == '1'){
								$checked = 'checked';

								}
								else {
									$checked = '';

								}

								if($userarray['level'] == '1'){
									$opt1 = 'selected';
								}
								else{
									$opt2 = 'selected';
								}

								if(isset($_POST['update'])){
									//update user bah
									$username = $_POST['username'];
									$name = $_POST['name'];
									$email = $_POST['email'];
									$enabled = (isset($_POST['enabled'])) ? 1 : 0;
									$access  = $_POST['level'];
									$password = $_POST['password'];

									if(empty($password)){
										$password = $userarray['password'];
									}
									else {
									//encrypt password
										$password = md5($password);
									}

									//sanitize input

									$username = mysqli_real_escape_string($dbc, $username);
									$name = mysqli_real_escape_string($dbc, $name);
									$email = mysqli_real_escape_string($dbc, $email);
									$enabled = mysqli_real_escape_string($dbc, $enabled);
									$access = mysqli_real_escape_string($dbc, $access);
									$password = mysqli_real_escape_string($dbc, $password);
									

									//sql 
									$sqlupdateuser = "UPDATE user SET name = '".$name."', username = '".$username."', password = '".$password."', email = '".$email."', level = '".$access."', enabled = '".$enabled."' WHERE id = '".$id."'";
									
									$query = mysqli_query($dbc, $sqlupdateuser);

									if(!$query){
										echo '<script type="text/javascript">alert("Fail to update user");window.location.href = "dashboard.php?page=preuser</script>';
										
									}
									else {

										echo '<script type="text/javascript">alert("User updated successfully");window.location.href = "dashboard.php?page=preuser";</script>';
										
									}

									
								}

									echo '
										<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
											<div class="row">
												<ol class="breadcrumb">
													<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
													<li class="active">Profile</li>
												</ol>
											</div><!--/.row-->
											
											<div class="row">
												<div class="col-lg-12">
													<h1 class="page-header">Edit Profile </h1>
												</div>
											</div><!--/.row-->
													
											
											<div class="row">
												<div class="col-lg-12">
													<div class="panel panel-default">
														<div class="panel-heading">Edit Profile :: '.$userarray['name'].'</div>
														<div class="panel-body">
															<div class="col-md-6">
																<form role="form" action="" method="POST">
																

																	<div class="form-group">
																		<label>Name</label>
																		<input class="form-control" name="name" value="'.$userarray['name'].'" >
																	</div>

																	<div class="form-group">
																		<label>Username</label>
																		<input class="form-control" name="username" value="'.$userarray['username'].'" >
																	</div>

																	<div class="form-group">
																		<label>Password</label>
																		<input type="password" name="password" class="form-control" >
																	</div>

																	<div class="form-group">
																		<label>Email</label>
																		<input class="form-control" name="email" value="'.$userarray['email'].'" >
																	</div>
																	
																	<div class="form-group">
																		<label>Access</label>
																		<select class="form-control" name="level">
																			<option value="2" '.$opt2.'>Admin</option>
																			<option value="1" '.$opt1.'>User</option>

																		</select>
																	</div>						
																	
																	<div class="form-group checkbox">
																	  <label>
																	    <input type="checkbox" name="enabled" '.$checked.'>Enabled</label>
																	</div>

																	<!--
																	<div class="form-group">
																		<label>File input</label>
																		<input type="file">
																		 <p class="help-block">Example block-level help text here.</p>
																	</div>
																	-->

																	<button type="submit" class="btn btn-primary" name="update">Save</button>
																	<button type="reset" class="btn btn-default">Reset</button>
																	
																</div>
															</form>
														</div>
													</div>
												</div><!-- /.col-->
											</div><!-- /.row -->
											
										</div>';

								}
								else {
									echo 'Application Error';
								}
					
							}
					}

				if($_GET['page'] == 'deluser'){
					if(isset($_GET['id'])){
						$id = $_GET['id'];
						$id = mysqli_real_escape_string($dbc, $id);

						$deletesql = "DELETE FROM user WHERE id = '".$id."'";

						$query = mysqli_query($dbc, $deletesql);

						if(!$query){
							echo '<script type="text/javascript">alert("Fail to delete user");window.location.href = "dashboard.php?page=news</script>';
								
						}
						else {

							echo '<script type="text/javascript">alert("User deleted successfully");window.location.href = "dashboard.php?page=news";</script>';
								
						}
					}
				}

				if($_GET['page'] == 'settings'){
					$sqlsetting = "SELECT * FROM settings";
					$query = mysqli_query($dbc, $sqlsetting);
					$rows = mysqli_num_rows($query);
					$settingarray = mysqli_fetch_array($query);

					if($settingarray['enabled'] == '1'){
						$checked = 'checked';

					}
					else {
						$checked = '';

					}

					if(isset($_POST['update'])){
						$sitename = $_POST['name'];
						$enabled = (isset($_POST['enabled'])) ? 1 : 0;

						$updatesql = "UPDATE settings SET sitename = '".$sitename."', enabled = '".$enabled."' ";

						$query = mysqli_query($dbc, $updatesql);

						if(!$query){
							echo '<script type="text/javascript">alert("Fail to save settings");window.location.href = "dashboard.php?page=settings</script>';
								
						}
						else {

							echo '<script type="text/javascript">alert("Settings saved successfully");window.location.href = "dashboard.php?page=settings";</script>';
								
						}

					}


					echo '
										<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
											<div class="row">
												<ol class="breadcrumb">
													<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
													<li class="active">Settings</li>
												</ol>
											</div><!--/.row-->
											
											<div class="row">
												<div class="col-lg-12">
													<h1 class="page-header">Settings </h1>
												</div>
											</div><!--/.row-->
													
											
											<div class="row">
												<div class="col-lg-12">
													<div class="panel panel-default">
														<div class="panel-heading">Settings</div>
														<div class="panel-body">
															<div class="col-md-6">
																<form role="form" action="" method="POST">
																

																	<div class="form-group">
																		<label>Site Name</label>
																		<input class="form-control" name="name" value="'.$settingarray['sitename'].'" >
																	</div>

																	
																	<div class="form-group checkbox">
																	  <label>
																	    <input type="checkbox" name="enabled" '.$checked.'>Site maintenance</label>
																	</div>

																	<!--
																	<div class="form-group">
																		<label>File input</label>
																		<input type="file">
																		 <p class="help-block">Example block-level help text here.</p>
																	</div>
																	-->

																	<button type="submit" class="btn btn-primary" name="update">Save</button>
																	<button type="reset" class="btn btn-default">Reset</button>
																	
																</div>
															</form>
														</div>
													</div>
												</div><!-- /.col-->
											</div><!-- /.row -->
											
										</div>';


				}


				if($_GET['page'] == 'about'){
					echo '
					<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
						<div class="row">
							<ol class="breadcrumb">
								<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
							<li class="active">About</li>
							</ol>
						</div><!--/.row-->

						<div class="row">
							<div class="col-lg-12">
								<h1 class="page-header">About Infomatic Board System</h1>
							</div>
						</div>
									
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-info">
									<div class="panel-heading">
										About
									</div>
									<div class="panel-body">
										<a class="navbar-brand" href="https://github.com/mzulfahmy"><span>Infomatic </span>Board System</a>
										<p>Infomatic Board system was build for Project Based Education by Mohamad Zulfahmy for Kolej Vokasional Shah Alam.</p>
										<p>Current build for this system is <b>v1.03 BETA</b></p>
										<br>

										<p>Feel free to contact me via Facebook @ <a href="https://fb.me/bforcex">https://fb.me/bforcex</a> <br> Project open-sourced at Github @ <a href="https://github.com/mzulfahmy">https://github.com/mzulfahmy</a></p>
									  	<div class="col-md-6">
    										<img src="images/logo.png">
  										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-info">
									<div class="panel-heading">
										System Changelog
									</div>
									<div class="panel-body">
										<b>V1.1 BETA (NEXT RELEASE)</b>
										<ol>
												<ul>	
													<li>Image on news</li>
													<li>User profile picture</li>
													<li>Search box</li>
												</ul>
										</ol>
										<b>V1.03 BETA (CURRENT)</b>
										<ol>
												<ul>	
													<li>User management</li>
													<li>Fixed SQL injection</li>
													<li>Improved system stability</li>
												</ul>
										</ol>
										<b>V1.02 BETA</b>
										<ol>
												<ul>
													<li>Setting page</li>
													<li>2 Level admin access</li>
												</ul>
										</ol>
										<b>V1.01 BETA</b>
										<ol>
												<ul>
													<li>Improved security</li>
													<li>Profile management</li>
													<li>Improved news management</li>
													<li>Database tuning</li>
												</ul>
										</ol>

										<b>V1.0 BETA</b>
										<ol>
											<li>First release
												<ul>
													<li>Dynamic news management</li>
													<li>Responsive web design</li>
													<li>User management</li>
												</ul>
											</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
					';
				}
			}
			else {
				if(isset($_POST['add'])){
					//grab data $_POST
					$title = $_POST['title'];
					$news = $_POST['news'];
					$level = $_POST['level'];
					//sanitize $_POST
					$title = mysqli_real_escape_string($dbc, $title);
					$news = mysqli_real_escape_string($dbc, $news);
					$level = mysqli_real_escape_string($dbc, $level);

					$date = date("Y-m-d");
					$user = $dataarray['name'];

					$addsql = 'INSERT INTO news (title, news, level, post_by, post_date, enabled) VALUES ("'.$title.'", "'.$news.'", "'.$level.'", "'.$user.'", "'.$date.'", "1")';

					$query = mysqli_query($dbc, $addsql);

					if(!$query){
						echo '<script type="text/javascript">alert("Fail to add news");window.location.href = "dashboard.php?page=news"</script>';
									
					}
					else {

						echo '<script type="text/javascript">alert("News added successfully");window.location.href = "dashboard.php?page=news";</script>';
									
					}
				}

				$countpost = "SELECT COUNT(*) as totalpost FROM news";
				$queryp = mysqli_query($dbc, $countpost);
				$arraypost = mysqli_fetch_array($queryp);

				$countpost1 = "SELECT COUNT(*) as approved FROM news WHERE enabled='1'";
				$queryp1 = mysqli_query($dbc, $countpost1);
				$arraypost1 = mysqli_fetch_array($queryp1);

				$countpost2 = "SELECT COUNT(*) as unapproved FROM news WHERE enabled='0'";
				$queryp2 = mysqli_query($dbc, $countpost2);
				$arraypost2 = mysqli_fetch_array($queryp2);

				$countuser = "SELECT COUNT(*) as users FROM user";
				$queryu = mysqli_query($dbc, $countuser);
				$arrayuser = mysqli_fetch_array($queryu);

				echo '
				<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
							<div class="row">
								<ol class="breadcrumb">
									<li><a href="dashboard.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
								</ol>
							</div>
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Dashboard</h1>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-3">
					<div class="panel panel-orange panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large">'.$arraypost['totalpost'].'</div>
								<div class="text-muted">Total Post</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-3">
					<div class="panel panel-blue panel-widget ">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large">'.$arraypost1['approved'].'</div>
								<div class="text-muted">Approved Post</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-3">
					<div class="panel panel-red panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large">'.$arraypost2['unapproved'].'</div>
								<div class="text-muted">Unapproved Post</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 col-lg-3">
					<div class="panel panel-teal panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large">'.$arrayuser['users'].'</div>
								<div class="text-muted">Total Users</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">Quick News</div>
							<div class="panel-body">
								<div class="col-md-6">
									<form role="form" action="" method="POST">
															
										<div class="form-group">
											<label>Title</label>
											<input class="form-control" name="title" value="" >
										</div>


										<div class="form-group">
											<label>News</label>
											<textarea class="form-control" rows="4" name="news"></textarea>
										</div>
																																																
									</div>
										<div class="col-md-6">
															
										<div class="form-group">
											<label>Priority</label>
											<select class="form-control" name="level">
												<option value="3" >Urgent</option>
												<option value="2" >Medium</option>
												<option value="1" >Low</option>
											</select>
										</div>
																
											<button type="submit" class="btn btn-primary" name="add">Add News</button>
											<button type="reset" class="btn btn-default">Reset</button>
									</div>
								</form>
							</div>
						</div>
					</div><!-- /.col-->
				</div><!-- /.row -->
										

				</div>


				';
		}



			include "footer.php";
		}
		else {
			header('Location: login.php');
		}



?>