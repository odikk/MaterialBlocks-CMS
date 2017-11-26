<?php
	/*
		BeardBlock - Froala design-blocks based CMS
	    Copyright (C) 2017  Robin Krause
	
	    This program is free software: you can redistribute it and/or modify
	    it under the terms of the GNU General Public License as published by
	    the Free Software Foundation, either version 3 of the License, or
	    (at your option) any later version.
	
	    This program is distributed in the hope that it will be useful,
	    but WITHOUT ANY WARRANTY; without even the implied warranty of
	    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	    GNU General Public License for more details.
	
	    You should have received a copy of the GNU General Public License
	    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */
    
    function LoginForm() {
	?>
	<section class="fdb-block" style="background-image: url(./fdb-imgs/bg_0.svg)">
		<div class="container">
			  <div class="row justify-content-center">
				<div class="col-12 col-md-8 col-lg-7 col-xl-5 text-center">
					  <div class="fdb-box">
						<div class="row">
							  <div class="col">
								<h1>Log In</h1>
							  </div>
						</div>
						<form action="index.php?site=dashboard&action=login" method="post">
							<div class="row mt-4">
								  <div class="col">
									<input class="form-control" name="email" placeholder="Email" type="email" required>
								  </div>
							</div>
							<div class="row mt-4">
								  <div class="col">
									<input class="form-control mb-1" name="password" placeholder="Password" type="password" required>
								  </div>
							</div>
							<div class="row mt-4">
								  <div class="col">
									<button class="btn btn-empty btn-round" type="submit">Log In</button>
								  </div>
							</div>
						</form>
					  </div>
				</div>
			  </div>
		</div>
	</section>
	<?php
	}
?>
