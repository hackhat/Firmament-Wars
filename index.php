<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head id='head'>
	<title>Firmament Wars | Free Multiplayer Risk-Like Grand Strategy War Game</title>
	<meta charset="utf-8">
	<meta name="keywords" content="free, risk, browser, multiplayer, online, strategy, html5">
	<meta name="description" content="A free multiplayer strategy game playable in your web browser! Gameplay is like Risk meets Civilization Revolution! Offers team, FFA, and ranked modes!">
	<meta name="author" content="Joe Leonard">
	<meta name="referrer" content="always">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="google-signin-client_id" content="1015425037202-g5ri6qnj14b8vrk33lnu130ver9f43ef.apps.googleusercontent.com">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
	<script>
		var app = {
			version: '1.0.1',
			initialized: 0, // init-game returned
			isApp: location.protocol === 'chrome-extension:' ? 1 : 0,
			account: ''
		};
		app.url = app.isApp ?
			'https://nevergrind.com/games/firmament-wars/' : '';
		app.socketUrl = app.isApp ?
			'nevergrind.com' : location.hostname;
		app.isServer = 0;
		if (!app.isApp && location.hostname === 'nevergrind.com'){
			app.isServer = 1;
		}
		app.isLocal = location.hostname.indexOf('localhost') > -1;
		app.loginUrl = app.isLocal ? '' : 'https://nevergrind.com';
		// fw only
		var isLoggedIn = 0;
	</script>
	<style>
		body {
			display: none;
		}
	</style>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-slider.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="shortcut icon" href="images/favicon.png">
</head>

<body id="body">
<script>
	(function(b){
		var e = document.createElement('link');
		e.href = 'css/firmament-wars.' + (app.isLocal ? 'css' : 'min.css') + '?v='+ app.version;
		e.rel = 'stylesheet';
		b.appendChild(e);
	})(document.body);
</script>

<div id="login-modal">
	<div id="login-backdrop"></div>
	<div id="login-container">
		<form id="loginWrap"
			  accept-charset="UTF-8"
			  class="strongShadow"
			  method="post"
			  onSubmit="return loginAuthenticate(this);">
			<fieldset>
				<p>
					<div>
						<a id="createAccount" class="login-actions strongShadow">Create Account</a>
					</div>
					<div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between">
						<hr class="fancyhr fancyhr-left" style="flex: 1">
						<div>or</div>
						<hr class="fancyhr fancyhr-right" style="flex: 1">
					</div>
					<div>
						<a id="gotoAccount" class="login-actions strongShadow">Login</a>
					</div>
				</p>
					<hr class="fancyhr">
				<div id="login-form-contents"></div>

				<div id="social-login-wrap">
					<hr class="fancyhr">

					<p>Or login with existing accounts:</p>

					<div id="google-wrap">
						<span id="my-signin2"></span>
					</div>

					<a id="twitter-wrap" href="/twitterLogin.php">
						<div id="twitter-icon-wrap">
							<i id="twitter-icon" class="fa fa-twitter"></i>
						</div>
						<div id="twitter-text">Sign in with Twitter</div>
					</a>

					<fb:login-button
						class="fb_button"
						data-width="176"
						data-max-rows="1"
						data-size="large"
						data-button-type="login_with"
						data-show-faces="false"
						data-auto-logout-link="false"
						data-use-continue-as="false"
						scope="public_profile,email"
						onlogin="checkLoginState();">
					</fb:login-button>
				</div>

				<hr class="fancyhr" style="margin: 1rem 0">
				<div>Problems?</div>
				<div>support@nevergrind.com</div>
			</fieldset>
		</form>
	</div>
</div> <!-- end login -->


	<div id="titleViewBackdrop"></div>

	<div id="title-bg-wrap" class="title-bg">
		<div id="title-backdrop"></div>

		<div id="title-stars-1"
			 class="title-bg title-stars"></div>
		<div id="title-stars-2"
			 class="title-bg title-stars"></div>
		<div id="title-stars-3"
			 class="title-bg title-stars"></div>

		<img src="images/title/title-bg-planet.png"
			 id="firmamentWarsBG"
			 class="title-bg">
	</div>

	<div id="mainWrap">

		<div id="titleMain">

			<header class="shadow4 text-primary fw-primary">
				<div>
					<a id="toggleNation" type="button" class="btn fwBlue btn-responsive shadow4">
						Configure Nation
					</a>
					<a id="leaderboardBtn" type="button" class="btn fwBlue btn-responsive shadow4">
						Leaderboard
					</a>
					<a id="logout" class="btn fwBlue btn-responsive shadow4">Loading...</a>
				</div>
				<div style="display: flex; align-items: center;">&ensp;
					<i id="options" class="pointer options fa fa-gear" title="Options"></i>
					<img src="images/neverworks-txt.png">
				</div>
				<!--div id="social-links" class="text-primary">
					<a href="//twitch.tv/maelfyn" target="_blank">
						<i class="fa fa-twitch text-primary pointer"></i>
					</a>
					<a href="//youtube.com/c/Maelfyn" target="_blank">
						<i class="fa fa-youtube text-primary pointer"></i>
					</a>
					<a href="//discord.gg/n2gp8rC" target="_blank">
						<i class="fa fa-discord text-primary pointer"></i>
					</a>
					<a href="//www.facebook.com/maelfyn" target="_blank">
						<i class="fa fa-facebook text-primary pointer"></i>
					</a>
					<a href="//twitter.com/maelfyn" target="_blank">
						<i class="fa fa-twitter text-primary pointer"></i>
					</a>
				</div-->

			</header>

			<div id="title-column-wrap">

				<div id="titleMenu" class="fw-primary">
					<img id="firmamentWarsLogo" src="images/title/firmament-wars-logo-1280.png">

					<div id="title-action-row" style="margin-top: 1rem;" class="fw-text">
						<div id="title-action-row-bg-right" class="title-action-bg"></div>
						<div id="action-button-wrap" class="no-select">
							<div id="play-now-btn" class="action-btn shadow4">Play Now</div>
							<div id="create" class="gameSelect action-btn shadow4">Free For All</div>
							<div id="createTeamBtn" class="gameSelect action-btn shadow4">Team Game</div>
							<div id="createRankedBtn" class="gameSelect action-btn shadow4">Create Ranked Match</div>
							<div id="joinRankedGame" class="gameSelect action-btn shadow4">Join Ranked Match</div>
							<div id="joinPrivateGameBtn" class="action-btn shadow4">Join Private Game</div>
							<div id="refresh-game-button" class="action-btn shadow4">Refresh Games</div>
						</div>
					</div>

					<div id="refreshGameWrap" class="buffer2">
						<table id="gameTable" class="table table-condensed table-borderless">
							<thead>
								<tr id="gameTableHead">
									<th class="gameTableCol1 warCells">Game Name</th>
									<th class="gameTableCol2 warCells">Map</th>
									<th class="gameTableCol3 warCells">Turn Duration</th>
									<th class="gameTableCol4 warCells">Type</th>
								</tr>
							</thead>
							<tbody id="gameTableBody"></tbody>
						</table>
					</div>
				</div>

				<div id="titleChat" class="fw-primary text-center">
					<div id="titleChatPlayers" class="titlePanelLeft row">
						<div id="title-chat-players-room">
							<div id="titleChatHeader" class="chat-warning nowrap">&nbsp;
								<span id="titleChatHeaderChannel"></span>
								<span id="titleChatHeaderCount"></span>
							</div>
							<div id="title-chat-btn-wrap" class="text-center">
								<div id="title-chat-btns" class="btn-group" role="group">
									<button id="friend-status" class="btn-group btn btn-xs btn-responsive fwBlue shadow4" title="Friend list">
										<i class="fa fa-users pointer"></i>
									</button>
									<button id="add-friend" class="btn-group btn btn-xs btn-responsive fwBlue shadow4" title="Toggle friend">
										<i class="fa fa-user-plus pointer"></i>
									</button>
									<button id="who-account" class="btn-group btn btn-xs btn-responsive fwBlue shadow4" title="Query account data">
										<i class="fa fa-vcard pointer"></i>
									</button>
									<button id="whisper-account" class="btn-group btn btn-xs btn-responsive fwBlue shadow4" title="Send another account a private message">@</button>
									<button id="change-channel" class="btn-group btn btn-xs btn-responsive fwBlue shadow4" title="Change Channel">#</button>
									<button id="ignore-user" class="btn-group btn btn-xs btn-responsive fwBlue shadow4" title="Ignore account messages">
										<i class="fa fa-microphone-slash pointer"></i>
									</button>
									<button id="get-help" class="btn-group btn btn-xs btn-responsive fwBlue shadow4" title="Help">
										<i class="fa fa-question pointer"></i>
									</button>
								</div>
							</div>
							<div id="titleChatBody"></div>
						</div>

						<div id="title-chat-players-log">
							<div id="titleChatLog" class="titlePanelLeft">
								<!--
									right chat window
									count from title screen
								-->
							</div>
						</div>
					</div>


					<div id="titleChatWrap">
						<div class="input-group">
							<input id="title-chat-input" class="fw-text noselect nobg form-control" type="text" maxlength="240" auto-complete="disabled" spellcheck="false" />
							<div id="titleChatSend" class="input-group-btn">
								<button id="titleChatSendBtn" class="btn shadow4 fwBlue">Send</button>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

		<div id="joinGameLobby" class="shadow4">

			<img id="worldTitle" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=">

			<div id="lobbyLeftCol">

				<div id="lobbyPlayers" class="fw-primary"></div>

				<div id="lobbyChatLogWrap" class="fw-primary lobbyRelWrap">
					<div id="lobbyChatLog"></div>

					<div id="lobbyChatWrap" class="lobbyRelWrap input-group">
						<input id="lobby-chat-input" class="fw-text noselect nobg form-control" type='text' maxlength="240" auto-complete="disabled" spellcheck="false"/>
						<span id="lobbyChatSend" class="input-group-addon shadow4 fwBlue">Chat</span>
					</div>
				</div>

			</div>

			<div id="lobbyRightCol">

				<div id="lobbyGame" class="fw-primary">
					<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" id="lobbyFirmamentWarsLogo">
					<div id="lobbyRankedMatch" class="shadow4 ranked">Ranked Match</div>
					<div id="lobbyGameNameWrap">
						<div class='text-primary margin-top'>Game Name:</div>
						<div id='lobbyGameName'></div>
					</div>
					<div id="lobbyGamePasswordWrap" class="none">
						<div class='text-primary margin-top'>Password:</div>
						<div id='lobbyGamePassword'></div>
					</div>
					<div class='text-primary margin-top'>Game Mode:</div>
					<div id='lobbyGameMode'></div>
					<div class='text-primary margin-top'>Map:</div>
					<div id='lobbyGameMap'></div>
					<div class='text-primary margin-top'>Speed:</div>
					<div id='lobbyGameSpeed'></div>
					<div class='text-primary margin-top'>Max Players:</div>
					<div id='lobbyGameMax'></div>
				</div>

				<div id="lobbyGovernmentDescription" class="fw-primary text-center lobbyRelWrap">
					<div id="lobbyGovName" class='text-primary'>Despotism</div>
					<div id="lobbyGovPerks"></div>
				</div>

				<div id="lobbyButtonWrap" class="fw-primary text-center lobbyRelWrap">
					<button id='startGame' type='button' class='btn btn-default btn-md btn-block btn-responsive shadow4 lobbyButtons none'>Start Game</button>
					<button id='cancelGame' type='button' class='btn btn-default btn-md btn-block btn-responsive shadow4 lobbyButtons'>Exit</button>
					<div id='countdown' class='text-warning'></div>
				</div>
			</div>

		</div>

		<div id='createGameWrap' class='fw-primary title-modals'>
			<button id='cancelCreateGame'
					type='button'
					class='close-btn-wrap btn btn-sm fwBlue shadow4'>
				<i class="close-btn fa fa-close"></i>
			</button>
			<div class='header text-center'>
				<h2 id="createGameHead" class="header">Create FFA Game</h2>
				<h2 id="createRankedGameHead" class='header ranked'>Create Ranked Game</h2>
			</div>
			<hr class="fancyhr">
			<div id="createGameFormWrap">

				<div id="createGameNameWrap">
					<div class='buffer2'>
						<label>Game Name</label>
					</div>
					<div class='buffer'>
						<input id='gameName' class='form-control createGameInput' type='text' maxlength='32' auto-complete='disabled'>
					</div>
				</div>

				<div id="createGamePasswordWrap">
					<div class='buffer2'>
						<label>Password (Private Game)</label>
					</div>

					<div class='buffer'>
						<input id='gamePassword' class='form-control createGameInput' type='text' maxlength='16' auto-complete='disabled'>
					</div>
				</div>

				<div id="createGameMaxPlayerWrap" class="pull-right">
					<div class='buffer2'>
						<label class='control-label'>Maximum Number of Players</label>
					</div>

					<div class='buffer'>
						<input id='gamePlayers' type='number' class='form-control createGameInput' id='gamePlayers' value='8' min='2' max='8'>
					</div>
				</div>

				<div id="createGameSpeedWrap">
					<div class='buffer2'>
						<label class='control-label'>Turn Duration</label>
					</div>

					<div class='buffer w33'>
						<div class='dropdown'>
							<button id="speedDropdownBtn" class='btn btn-primary dropdown-toggle shadow4 fwDropdownButton' type='button' data-toggle='dropdown'>
								<span id='createGameSpeed'>15</span>
								<i class="fa fa-caret-down text-warning lobbyCaret"></i>
							</button>
							<ul id='speedDropdown' class='dropdown-menu fwDropdown createGameInput' value="15">
								<li><a class='speedSelect' href='#'>15</a></li>
								<li><a class='speedSelect' href='#'>20</a></li>
								<li><a class='speedSelect' href='#'>25</a></li>
								<li><a class='speedSelect' href='#'>30</a></li>
							</ul>
						</div>
					</div>
				</div>

				<div>
					<div class='buffer2'>
						<label class='control-label'>Map</label>
					</div>

					<div class='buffer w33'>
						<div class='dropdown'>
							<button class='btn btn-primary dropdown-toggle shadow4 fwDropdownButton' type='button' data-toggle='dropdown'>
								<span id='createGameMap'>Earth Omega</span>
								<i class="fa fa-caret-down text-warning lobbyCaret"></i>
							</button>
							<ul id='mapDropdown' class='dropdown-menu fwDropdown createGameInput'></ul>
						</div>
					</div>

					<div class='buffer2'>
						<label class='control-label'>Map Details</label>
					</div>
					<div class='buffer'>
						<span title='Max players on this map'>
							<i class='fa fa-users'></i>
							<span id='createGamePlayers'>8</span>
						</span>&ensp;
						<span title='Number of territories on this map'>
							<i class='fa fa-globe'></i>
							<span id='createGameTiles'>78</span>
						</span>
					</div>
				</div>
			</div>
			<div>
				<hr class='fancyhr'>
			</div>
			<div id="create-game-form-foot" class='text-center'>
				<button id='createGame' type='button' class='btn btn-md fwGreen btn-responsive shadow4'>Create Game</button>
			</div>
		</div>

		<div id="joinPrivateGameModal" class="fw-primary container title-modals">
			<button id='cancelCreateGame'
					type='button'
					class='close-btn-wrap btn btn-sm fwBlue shadow4'>
				<i class="close-btn fa fa-close"></i>
			</button>
			<div class="row text-center">
				<div class='col-xs-12'>
					<h2 class='header'>Join Private Game</h2>
					<hr class="fancyhr">
				</div>
			</div>

			<div class="row buffer2 privateRow">
				<div class='col-xs-4 privateLabel'>
					<label class="control-label">Game Name</label>
				</div>
				<div class='col-xs-8'>
					<input type="text" class="joinGameInputs fwBlueInput" id="joinGame" maxlength="32" placeholder="Game Name">
				</div>
			</div>

			<div class="row buffer2 privateRow">
				<div class='col-xs-4 privateLabel'>
					<label class="control-label">Password</label>
				</div>
				<div class='col-xs-8'>
					<input type="text" class="joinGameInputs fwBlueInput" id="joinGamePassword" maxlength="16" placeholder="Password (Private Game)">
				</div>
			</div>

			<div class='row buffer text-center'>
				<div class='col-xs-12'>
					<hr class="fancyhr">
					<button id="joinPrivateGameBtn"
							type="button"
							style="margin-top: 5px"
							class="btn btn-md fwGreen btn-responsive shadow4">Join Game</button>
				</div>
			</div>
		</div>

		<div id="configureNation" class="fw-primary container title-modals">
			<button id='configureNationDone'
					type='button'
					class='close-btn-wrap btn btn-sm fwBlue shadow4'>
				<i class="close-btn fa fa-close"></i>
			</button>

			<div class="text-center">
				<div>
					<h2 class='header'>Update Name</h2>
					<hr class="fancyhr">
				</div>
			</div>

			<div id="configure-nation-name">
				<div>
					<div class="input-group">
						<input id="updateNationName" class="form-control" type="text" maxlength="32" auto-complete="disabled" size="24" aria-describedby="updateNationNameStatus" placeholder="Enter New Nation Name">
						<span class="input-group-btn">
							<button id="submitNationName" class="btn fwBlue shadow4" type="button">
								Update Nation Name
							</button>
						</span>
					</div>
				</div>
			</div>

			<div class="text-center">
				<div>
					<hr class="fancyhr">
					<h2 class='header'>Update Flag</h2>
					<hr class="fancyhr">
				</div>
			</div>

			<div id="configure-nation-flag-flex" class="text-center">
				<div>
					<div class="dropdown">
						<button class="btn dropdown-toggle shadow4 fwDropdownButton" type="button" data-toggle="dropdown">
							<span id="selectedFlag"></span>
							<i class="fa fa-caret-down text-warning lobbyCaret"></i>
						</button>
						<ul id="flagDropdown" class="dropdown-menu fwDropdown"></ul>
					</div>
					<div id="flagPurchased" class="flagPurchasedStatus"></div>
				</div>

				<div>
					<img id="updateNationFlag" class="w100 block center" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=">
				</div>
			</div>


			<div class="text-center">
				<div>
					<hr class="fancyhr">
					<h2 class='header'>Update Avatar</h2>
					<hr class="fancyhr">
				</div>
			</div>

			<div id="configure-nation-avatar">
				<div style="flex-basis: 33%">
					<p>Upload your dictator avatar.<br>A 200x200 image is recommended.<br>Image must be a jpg < 40 kb:</p>
					<p>
						<input id="dictatorAvatar" class="btn btn-primary fwBlue shadow4" type="file" accept=".jpg" name="image">
					</p>
					<p id="uploadErr" class="text-warning"></p>
				</div>
				<div style="flex-basis: 67%">
					<img id="configureAvatarImage" class="dictator">
				</div>
			</div>
		</div>

		<div id="leaderboard" class="fw-primary title-modals">
			<button id='leaderboardDone'
					type='button'
					class='close-btn-wrap btn btn-sm fwBlue shadow4'>
				<i class="close-btn fa fa-close"></i>
			</button>
			<div id="leaderboard-head">
				<div>
					<button id="leaderboardFFABtn" type="button" class="btn fwBlue btn-responsive shadow4">FFA</button>
					<button id="leaderboardTeamBtn" type="button" class="btn fwBlue btn-responsive shadow4">Team</button>
					<button id="leaderboardRankedBtn" type="button" class="btn fwBlue btn-responsive shadow4 ranked">Ranked</button>
					<button id="leaderboard-trips-btn" type="button" class="btn fwBlue btn-responsive shadow4">Trips</button>
					<button id="leaderboard-quads-btn" type="button" class="btn fwBlue btn-responsive shadow4">Quads</button>
					<button id="leaderboard-pents-btn" type="button" class="btn fwBlue btn-responsive shadow4">Pents</button>
				</div>
			</div>

			<hr class="fancyhr">
			<div id="leaderboardBody">
				<div class="text-center">Loading...</div>
			</div>
		</div>

	</div>

	<div id="gameWrap">

		<div id="targetWrap">
			<div id="avatarWrap">
				<img id="avatar" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=">
			</div>
			<div id="targetName" class="text-center shadow4 no-select">
				<div id="targetNameAnchor">
					<img id="targetFlag" class="targetFlag" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=">
					<div>
						<i id="targetCapStar" class="glyphicon glyphicon-star capitalStar no-select shadow4 none"></i>
						<span id="targetNameWrap"></span>
					</div>
					<div id="targetResources"></div>
				</div>
			</div>
		</div>

		<div id="resources-ui" class="shadow4 blueBg gameWindow">
			<div id="resourceBody">
				<div id="troop-flex" title="Deploy troops to conquered territories">
					<div id="available-troops">
						<div>Available</div>
						<div>Troops</div>
					</div>
					<div id="manpower">0</div>
				</div>

				<div class="barWrap resourceBarParent">
					<div id="energyIndicator"></div>
					<span id="energy-label"
						  class="no-padding moves"
					 	  title="Turn ends when time expires or when all players have spent their energy">
						Energy <i class="fa fa-bolt"></i>
					</span>
					<span class="resourceIndicator"
					 	 title="Energy is used to move and rush troops.">
						<span id="moves">4</span>
						(+<span id="sumMoves">4</span>)
					</span>
				</div>

				<div id="prod-wrap">
					<div class="production resource-flex">
						<span title="Productions Bonus">
							+<span id="productionBonus">0</span>%
						</span>
						<span title="Production is used to deploy troops, build structures, and research technology.">
							Production <i class="fa fa-gavel"></i>
						</span>
					</div>

					<div class="no-padding">
						<div class="resourceIndicator">
							<span id="production">0</span>
							<span title="Production per turn">
								(+<span id="sumProduction">0</span>)
							</span>
						</div>
					</div>
				</div>

				<div id="food-wrap">
					<div class="food resource-flex">
						<span  title="Food Bonus">
							+<span id="foodBonus">0</span>%
						</span>
						<span  title="Food milestones produce additional troops">
							Food <i class="fa fa-apple"></i>
						</span>
					</div>

					<div id="foodBarWrap" class="barWrap resourceBarParent">
						<div id="foodBar" class="resourceBar"></div>
						<div class="resourceIndicator resourceCenter abs">
							<span id="food">0</span>/<span id="foodMax">25</span>
							(+<span id="sumFood">0</span>)
						</div>
					</div>
				</div>

				<div id="culture-wrap">
					<div class="culture resource-flex">
						<span  title="Culture Bonus">
							+<span id="cultureBonus">0</span>%
						</span>
						<span  title="Culture milestones produce special rewards">
							Culture <i class="fa fa-flag"></i>
						</span>
					</div>

					<div id="cultureBarWrap" class="barWrap resourceBarParent">
						<div id="cultureBar" class="resourceBar"></div>
						<div class="resourceIndicator resourceCenter abs">
							<span id="culture">0</span>/<span id="cultureMax">300</span>
							(+<span id="sumCulture">0</span>)
						</div>
					</div>
				</div>
			</div>


			<div id="ui2" class="blueBg gameWindow">
				<div id="ui2-head" class="stagBlue">
					<span id='manpowerWrap' class="manpower pull-left">
						<span
							data-placement="bottom"
							title="Great Generals boost troop attack">
							<i class="glyphicon glyphicon-star"></i>
							<span id="oBonus">0</span>
						</span>&thinsp;
						<span
							data-placement="bottom"
							title="Great Tacticians boost troop defense">
							<i class="fa fa-shield"></i>
							<span id="dBonus">0</span>
						</span>
					</span>
				</div>

				<div id="tileActions" class="container w100">
					<div class="row actionHead shadow4">
						<i class="fa fa-bolt moves resourceIcon"></i>Command
					</div>

					<div id="attack" class="actionButtons row"
						title="Attack with all troops">
						<div class="col-xs-9">
							<span class='text-hotkey'>A</span>ttack
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='attackCost'>2</span>
						</div>
					</div>

					<div id="splitAttack" class="actionButtons row"
						title="Attack with half of your troops">
						<div class="col-xs-9">
							<span class='text-hotkey'>S</span>plit Attack
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							</i><span id="splitAttackCost">1</span>
						</div>
					</div>

					<div id="rush" class="actionButtons row"
						title="Deploy 2 troops using energy instead of production. Boosted by culture.">
						<div class="col-xs-9">
							<span class='text-hotkey'>R</span>ush Troops
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							</i><span id="rushCost">2</span>
						</div>
					</div>

					<div class="row actionHead shadow4">
						<i class="fa fa-gavel production resourceIcon"></i>Build
					</div>

					<div id="deploy" class="actionButtons row"
						title="Deploy troops to a tile">
						<div class="col-xs-9">
							<span class='text-hotkey'>D</span>eploy Troops
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='deployCost'>10</span>
						</div>
					</div>

					<div id="upgradeTileDefense" class="actionButtons row"
						title="Bunkers boost tile defense +5">
						<div class="col-xs-9">
							<span class='text-hotkey'>B</span>uild <span id="buildWord">Bunker</span>
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id="buildCost"></span>
						</div>
					</div>

					<div id="fireCannons" class="actionButtons row none"
						title="Fire cannons at an adjacent tile. Kills 2-4 troops.">
						<div class="col-xs-9">
							Fire <span class='text-hotkey'>C</span>annons
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='cannonsCost'>24</span>
						</div>
					</div>

					<div id="launchMissile" class="actionButtons row none"
						title="Launch a missile at any territory. Kills 7-12 troops.">
						<div class="col-xs-9">
							Launch <span class='text-hotkey'>M</span>issile
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='missileCost'>50</span>
						</div>
					</div>

					<div id="launchNuke" class="actionButtons row none"
						title="Launch a nuclear weapon at any enemy territory. Kills 80-99% of troops and destroys all structures.">
						<div class="col-xs-9">Launch <span class='text-hotkey'>N</span>uke</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='nukeCost'>150</span>
						</div>
					</div>

					<div id="tileActionsOverlay"></div>

				</div>

				<div id="tileResearch" class="container w100">
					<div class="row actionHead shadow4">
						<i class="fa fa-gavel production resourceIcon"></i>Research
					</div>

					<div id="researchMasonry" class="actionButtons row"
						title="Research masonry to unlock bunkers.">
						<div class="col-xs-9">
							Masonr<span class='text-hotkey'>y</span>
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='masonryCost'>40</span>
						</div>
					</div>

					<div id="researchConstruction" class="actionButtons row none"
						title="Research construction to unlock walls.">
						<div class="col-xs-9">
							C<span class='text-hotkey'>o</span>nstruction
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='constructionCost'>60</span>
						</div>
					</div>

					<div id="researchEngineering" class="actionButtons row none"
						title="Research engineering to unlock walls and fortresses.">
						<div class="col-xs-9">
							<span class='text-hotkey'>E</span>ngineering
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='engineeringCost'>80</span>
						</div>
					</div>

					<div id="researchGunpowder" class="actionButtons row"
						title="Research gunpowder to unlock cannons.">
						<div class="col-xs-9">
							<span class='text-hotkey'>G</span>unpowder
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='gunpowderCost'>60</span>
						</div>
					</div>

					<div id="researchRocketry" class="actionButtons row none"
						title="Research rocketry to unlock missiles.">
						<div class="col-xs-9">
							Roc<span class='text-hotkey'>k</span>etry
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='rocketryCost'>200</span>
						</div>
					</div>

					<div id="researchAtomicTheory" class="actionButtons row none"
						title="Research atomic theory to unlock nuclear weapons.">
						<div class="col-xs-9">
							A<span class='text-hotkey'>t</span>omic Theory
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='atomicTheoryCost'>500</span>
						</div>
					</div>

					<div id="researchFutureTech" class="actionButtons row none"
						title="Research future technology.">
						<div class="col-xs-9">
							<span class='text-hotkey'>F</span>uture Tech
						</div>
						<div class="col-xs-3 tight2 text-right productionCost">
							<span id='futureTechCost'>800</span>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div id="currentYearWrap" class="shadow4">
			<!--button id="endTurn" class="btn btn-xs btn-responsive fwBlue">End Turn</button-->
			<span id="currentYear">4000 B.C.</span>
		</div>

		<div id="hotkey-ui" class="shadow4">Press V to toggle the UI</div>
		<div id="diplomacy-ui" class="shadow4 blueBg gameWindow">
			<div id="resourceHead">
				<div id="resource-head-right"></div>
				<i id="resync" class="pointer options fa fa-refresh" title="Attempt to resynchronize game data. Try this if your game seems to be in a bugged state"></i>
				<i id="hotkeys" class="pointer options fa fa-keyboard-o" title="Hotkeys"></i>
				<i id="options" class="pointer options fa fa-gear" title="Options"></i>
				<i id="surrender" class="pointer fa fa-flag" title="Surrender"></i>
				<i id="exitSpectate" class="pointer fa fa-times-circle none"></i>
			</div>
			<div id="diplomacy-body"></div>
		</div>

		<table id="chat-ui" class="fw-text no-select no-point">
			<tr>
				<td id="chat-content"></td>
			</tr>
		</table>

		<div id="chat-input-wrap" class="input-group">
			<span class="input-group-addon fwBlue shadow4" id="chat-input-send">
				<i class="fa fa-send pointer2"></i>
			</span>
			<input id="chat-input" class="fw-text nobg" type='text' maxlength="240" auto-complete="disabled" spellcheck="false"/>
		</div>
		<button id="chat-input-open" class="btn fwBlue shadow4 gameWindow">
			<i class="fa fa-comment pointer2"></i>
		</button>

		<div id="worldWrap">
		</div>

		<div id="hud" class="shadow4">Select Target</div>

		<div id="surrenderScreen" class="fw-primary fw-text">
			<p>Surrender? Are You Sure?</p>
			<div id="cancelSurrenderButton" class="endBtn">
				<div class="modalBtnChild">Cancel</div>
			</div>
			<div id="surrenderButton" class="endBtn">
				<div class="modalBtnChild">Surrender</div>
			</div>
		</div>

		<div id="victoryScreen" class="fw-primary fw-text"></div>

		<div id="statWrap" class="fw-text"></div>

	</div>

	<audio id="bgmusic" autoplay loop preload="auto"></audio>

	<div id="hotkeysModal" class='fw-primary title-modals'>
			<button id='hotkeysDone'
					type='button'
					class='close-btn-wrap btn btn-sm fwBlue shadow4'>
				<i class="close-btn fa fa-close"></i>
			</button>
		<h2 style="margin-bottom: .5rem" class='header text-center'>Hotkeys</h2>
		<hr class="fancyhr">

		<div id="hotkeysFormWrap" class="container w100">
			<div class='row buffer2'>
				<div class='col-xs-4'>
					A
				</div>
				<div class='col-xs-8'>
					Attack
				</div>
				<div class='col-xs-4'>
					S
				</div>
				<div class='col-xs-8'>
					Split Attack (only attack with half)
				</div>
				<div class='col-xs-4'>
					R
				</div>
				<div class='col-xs-8'>
					Rush troops by drafting local citizens
				</div>
				<div class='col-xs-4'>
					D
				</div>
				<div class='col-xs-8'>
					Deploy troops to the active tile
				</div>
				<div class='col-xs-4'>
					TAB
				</div>
				<div class='col-xs-8'>
					Next Target
				</div>
				<div class='col-xs-4'>
					SHIFT+TAB
				</div>
				<div class='col-xs-8'>
					Previous Target
				</div>
				<div class='col-xs-4'>
					ENTER
				</div>
				<div class='col-xs-8'>
					Open Chat
				</div>
				<div class='col-xs-4'>
					ESC
				</div>
				<div class='col-xs-8'>
					Clear Chat/Target
				</div>
				<div class='col-xs-4'>
					V
				</div>
				<div class='col-xs-8'>
					Toggle UI
				</div>
				<div class='col-xs-4'>
					CTRL+R
				</div>
				<div class='col-xs-8'>
					Reply to last private message
				</div>
			</div>
		</div>
	</div>

	<div id="optionsModal" class='fw-primary title-modals'>
		<button id='optionsDone' type='button' class='close-btn-wrap btn btn-sm fwBlue shadow4'>
			<i class="close-btn fa fa-close"></i>
		</button>
		<h2 style="margin-bottom: .5rem;" class='header text-center'>Options</h2>
		<hr class="fancyhr">
		<div id="optionsFormWrap" class="container w100">

			<div class='row buffer2'>
				<div class='col-xs-4'>
					Music Volume
				</div>
				<div class='col-xs-8 text-right'>
					<input id="musicSlider" class="sliders" type="text"/>
				</div>
				<div class='col-xs-4 buffer2'>
					Sound Effect Volume
				</div>
				<div class='col-xs-8 text-right buffer2'>
					<input id="soundSlider" class="sliders" type="text"/>
				</div>
			</div>
			<div id="options-app-only">
				<div class="row">
					<div class='col-xs-6 buffer2'>
						Window Size
					</div>
					<div class='col-xs-6 buffer'>

						<div id="window-select-wrap" class="dropdown">
							<button class="btn dropdown-toggle shadow4 fwDropdownButton" type="button" data-toggle="dropdown">
								<span id="window-size">Full Screen</span>
								<i class="fa fa-caret-down text-warning lobbyCaret"></i>
							</button>
							<ul class="dropdown-menu fwDropdown">
								<li id="window-full-screen" class="window-select">
									<a href="#">Full Screen</a>
								</li>
								<li id="window-1080" class="window-select">
									<a href="#">Windowed - 1920x1080</a>
								</li>
								<li id="window-720" class="window-select">
									<a href="#">Windowed - 1280x720</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div id='exit-game' class='shadow4'>Exit Game</div>
			</div>
		</div>
	</div>

	<div id="screenFlash"></div>
	<div id="overlay" class="portal"></div>
	<div id="Msg" class="shadow4"></div>
</body>

<script src="js/libs/TweenMax.min.js"></script>
<script src="js/libs/jquery.min.js"></script>
<script src="js/libs/Draggable.min.js"></script>
<script src="js/libs/DrawSVGPlugin.min.js"></script>
<script src="js/libs/SplitText.min.js"></script>
<script src="js/libs/autobahn.min.js"></script>
<script src="js/libs/bootstrap.min.js"></script>
<script src="js/libs/bootstrap-slider.min.js"></script>


<script>
	var login = {
		lock: 0,
		init: function() {
			setTimeout(function(){
				document.getElementById('login-form-contents').innerHTML = login.getLoginHtml();
				$("#loginWrap").attr('onSubmit', 'return loginAuthenticate(this)');
			});
			$("#gotoAccount").on('click', function(){
				document.getElementById('login-form-contents').innerHTML = login.getLoginHtml();
				$("#loginWrap").attr('onSubmit', 'return loginAuthenticate(this)');
			});
			$("#createAccount").on('click', function(){
				document.getElementById('login-form-contents').innerHTML = login.getCreateHtml();
				$("#loginWrap").attr('onSubmit', 'return login.createAccount(this)');
			});
		},
		getLoginHtml: function(){
			var s =
				'<label class="textLeft" for="loginEmail">Account or Email Address' +
				'<input name="username"' +
					'type="text"' +
					'id="loginEmail"' +
					'class="loginInputs shadow4"' +
					'maxlength="255"' +
					'placeholder="Account or Email Address"' +
					'required="required"' +
					'spellcheck="false"/>' +
				'</label>' +
				'<label class="textLeft" for="password">Password' +
					'<input name="password"' +
						'type="password"' +
						'id="password"' +
						'class="loginInputs shadow4"' +
						'maxlength="20"' +
						'auto-complete="current-password"' +
						'placeholder="Password"' +
						'required="required" />' +
				'</label>' +
				'<label for="rememberMe">' +
					'<input type="checkbox" id="rememberMe" name="rememberMe" checked> Remember Me' +
				'</label>' +
				'<input id="login-btn" type="submit" value="Login" class="fwBlue btn-responsive shadow4" />' +
				'<div class="error-msg shadow4"></div>' +
				'<div id="forgotPasswordWrap">' +
					'<a id="forgotPassword">Forgot Password?</a>' +
				'</div>';
			return s;
		},
		getCreateHtml: function() {
			var s =
				'<label class="textLeft" for="loginEmail">Email Address' +
					'<input name="username" ' +
					'type="text" ' +
					'id="loginEmail" ' +
					'auto-complete="disabled" '+
					'class="loginInputs shadow4" ' +
					'maxlength="255" ' +
					'placeholder="Account or Email Address" ' +
					'required="required" ' +
					'spellcheck="false"/></label>' +
				'<label class="textLeft" ' +
					'for="password">Password' +
					'<input name="password" ' +
					'type="password" ' +
					'auto-complete="disabled" '+
					'id="password" ' +
					'class="loginInputs shadow4" ' +
					'maxlength="20" ' +
					'placeholder="Password" required="required" /></label>' +
				'<label class="textLeft create-account signupHeader" ' +
					'for="loginAccount">Account Name' +
					'<input name="account" ' +
					'type="text" ' +
					'name="account" ' +
					'auto-complete="disabled" '+
					'id="loginAccount" ' +
					'class="loginInputs create-account shadow4" ' +
					'maxlength="16" ' +
					'placeholder="Account Name" ' +
					'required="required" /></label>' +
				'<div id="tosWrap" class="create-account">' +
					'<span id="tos" class="aqua">' +
					'<a target="_blank" href="//nevergrind.com/blog/terms-of-service/">Terms of Service</a> | <a target="_blank" href="//nevergrind.com/blog/privacy-policy/">Privacy Policy</a></span>' +
				'</div>' +
				'<input id="create-account" type="submit" value="Create" class="ng-btn fwBlue btn-responsive shadow4" />' +
				'<div class="error-msg shadow4"></div>';
			return s;
		},
		createAccount: function() {
			if (login.lock) {
				return false;
			}
			var pw = $("#password").val(),
				acc = $("#loginAccount").val();

			if (acc.length < 2) {
				loginMsg("Your account name must be more than two characters long.");
				return false;
			}
			if (acc.length > 16) {
				loginMsg("Your account name must be less than 16 characters long.");
				return false;
			}
			var tempAcc = acc.replace('_', '');
			if (tempAcc.match(/[a-z0-9]/gi, '').length < tempAcc.length) {
				loginMsg("Your account name should only contain letters, numbers, and underscores.");
				return false;
			}
			if (pw.length < 6) {
				loginMsg("Your password must be at least six characters long.");
				return false;
			}
			loginMsg("Connecting to server...");
			login.lock = 1;
			/*,
				referral: $("#referFriend").val().toLowerCase()
			*/
			var email = $("#loginEmail").val().toLowerCase(),
				account = acc.toLowerCase();
			$.ajax({
				type: 'POST',
				url: app.loginUrl + '/php/master1.php',
				data: {
					run: "createAccount",
					email: email,
					account: account,
					password: pw,
					promo: ''
				}
			}).done(function(data) {
				if (data.indexOf("Account Created") === -1){
					// something went wrong
					loginMsg(data);
				} else {
					loginMsg("Account Created! Reloading!");
					setTimeout(function(){
						location.reload();
					}, 100);
				}
			}).fail(function() {
				loginMsg("There was a problem communicating with the server.");
			}).always(function() {
				login.lock = 0;
			});
			return false; // prevent form submission
		}
	}
	login.init();
	// loginModal.php
	sessionStorage.setItem('refer', location.pathname);
	// FB SSO
	if (app.isServer) {
		window.fbAsyncInit = function () {
			FB.init({
				appId: '737706186279455',
				cookie: true,
				xfbml: true,
				version: 'v2.8'
			});
			/*
			FB.getLoginStatus(function (response) {
				fbLoginCallback(response);
			});
			*/
			// only triggers upon login event
			FB.Event.subscribe('auth.authResponseChange', function (response) {
				response.status === 'connected' && fbLoginCallback(response);
			});
		}
	}
	function checkLoginState() { // called from FB button
		FB.getLoginStatus(function(response) {
			fbLoginCallback(response);
		});
	}
	function fbLoginCallback(response){
		if (app.isServer) {
			if (response && response.status === 'connected') {
				// Logged into your app and Facebook.
				var token = response.authResponse.accessToken;
				if (token) {
					loginAuthenticationLock = true;
					FB.api('/me', {
						fields: 'email'
					}, function (response) {
						$.ajax({
							type: 'POST',
							url: app.loginUrl + '/php/master1.php',
							data: {
								run: 'authenticate',
								facebookToken: token
							}
						}).done(function (data) {
							if (data === 'Create an account name!') {
								// redirect to
								var to = 'https://nevergrind.com/setAccount.php';
								window.location = to;
							} else {
								// it's coming out here for some reason
								loginGotoRefer(data, undefined, 'fbLoginCallback');
							}
						}).fail(function (data) {
							loginMsg(data.statusText);
						}).always(function () {
							loginAuthenticationLock = false;
						});
					});
				} else {
					loginMsg("Facebook credentials could not be verified.");
				}
			}
		}
	}

	// google SSO
	function loginRenderButton() {
		if (app.isServer || app.isApp) {
			gapi.load('auth2', function () {
				gapi.auth2.init();
				gapi.signin2.render('my-signin2', {
					scope: 'profile email openid',
					width: 240,
					height: 40,
					longtitle: true,
					theme: 'dark',
					onsuccess: function (googleUser) {
						var token = googleUser.getAuthResponse().id_token;
						if (token) {
							loginAuthenticationLock = true;
							$.ajax({
								type: 'POST',
								url: app.loginUrl + '/php/master1.php',
								data: {
									run: 'authenticate',
									googleToken: token
								}
							}).done(function (data) {
								console.info('google login? ', data);
								if (data === 'Create an account name!') {
									// redirect to
									var to = 'https://nevergrind.com/setAccount.php';
									window.location = to;
								} else {
									// it's coming out here for some reason data === Login successful!
									loginGotoRefer(data, undefined, 'loginRenderButton');
								}
							}).fail(function (data) {
								loginMsg(data.statusText);
							}).always(function () {
								loginAuthenticationLock = false;
							});
						}
					},
					onfailure: function () {
						console.log('error: ', error);
					}
				});
			});
		}
	}

	var loginFadeTimer = new TweenMax.delayedCall(0, '');;
	function fadeOut(){
		loginFadeTimer.kill();
		loginFadeTimer = TweenMax.to('.error-msg', 0, {
			opacity: 1,
			height: 'auto',
			display: 'block',
			onComplete: function(){
				TweenMax.to('.error-msg', 1, {
					delay: 8,
					transformOrigin: '50% 0',
					transformPerspective: 500,
					rotationX: -90,
					height: 0,
					opacity: 0,
					onComplete: function(){
						$(".error-msg").html('');
					}
				});
			}
		});
	}
	function loginMsg(msg){
		var str = "<div>" + msg + "</div>";
		$(".error-msg").html(str);
		fadeOut();
		TweenMax.set('.error-msg', {
			transformOrigin: '50% 0',
			transformPerspective: 500,
			rotationX: 0
		})
	}
	$('#login').on('click', function() {
		loginAuthenticate();
	});
	$("#login-form-contents").on('click', '#forgotPassword', function() {
		if (this.textContent === "Checking...") {
			return;
		}
		var email = $("#loginEmail").val().toLowerCase();
		var msg = "Forgot Password?";
		$("#forgotPassword").text("Checking...");
		if (!email || email.length < 3) {
			loginMsg("Enter a valid email address");
			$("#forgotPassword").text(msg);
			return;
		}
		loginMsg("Checking account status...");
		$.ajax({
			url: app.loginUrl + '/php/master1.php',
			data: {
				run: "forgotPassword",
				email: email
			}
		}).done(function(data){
			loginMsg(data, 0, 0, 8000);
			$("#forgotPassword").text(msg);
		});
	});

	var loginFocusInput = false,
		loginAuthenticationLock = false;

	$(".loginInputs").on('focus', function() {
		loginFocusInput = true;
	}).on('blur', function() {
		loginFocusInput = false;
	});
	// delegate login events
	$("#login-form-contents").on('click', '#login-btn', function(){
		loginAuthenticate();
	}).on('click', '#create-account', function(){
		login.createAccount();
	});

	$('.loginInputs').on('keydown', function(e){
		// hit enter
		if(e.keyCode === 13){
			loginAuthenticate();
		}
	});
	function loginAuthenticate(f) {
		if (loginAuthenticationLock === true) {
			return false;
		}
		if ($("#loginEmail").val().length < 3) {
			loginMsg("This is not a valid email address.");
			return false;
		}
		if ($("#password").val().length < 6 && !token) {
			loginMsg("Passwords must be at least six characters long.");
			return false;
		}
		var loginEmail = $("#loginEmail").val().toLowerCase();
		if ($("#rememberMe").prop('checked')){
			localStorage.setItem('email', loginEmail);
			localStorage.setItem('token', token);
		} else {
			localStorage.removeItem('email');
		}
		loginMsg("Connecting to server...");
		loginAuthenticationLock = true;

		$.ajax({
			type: 'POST',
			url: app.loginUrl + '/php/master1.php',
			data: {
				run: 'authenticate',
				email: loginEmail,
				password: $("#password").val()
			}
		}).done(function(data){
			loginGotoRefer(data, undefined, 'loginAuthenticate');
		}).fail(function(data) {
			loginMsg(data.statusText);
		}).always(function(){
			loginAuthenticationLock = false;
		});
		return false; // prevent form submission
	}
	function loginTokenAuthenticate(){
		$.ajax({
			type: 'POST',
			url: app.loginUrl + '/php/master1.php',
			data: {
				run: 'authenticate',
				email: email,
				token: token
			}
		}).done(function(data){
			loginGotoRefer(data, true, 'loginTokenAuthenticate');
		}).always(function(){
			document.getElementsByTagName('body')[0].style.visibility = 'visible';
		});
	}
	function loginGotoRefer(data, suppress, origin){
		function redirect(){
			if (app.isApp){
				location.reload();
			}
			else {
				console.info("redirect", sessionStorage.getItem('refer'), location.pathname);
				if (sessionStorage.getItem('refer') === location.pathname) {
					location.reload();
				}
				else {
					location.replace(target);
				}
			}
		}
		var target = app.url + (sessionStorage.getItem('refer') || '');
		if (data === 'Create an account name!'){
			location.replace("https://nevergrind.com/setAccount.php");
		} else if (data === "Login successful!"){
			if (origin === 'loginRenderButton'){
				$("#login-modal").remove();
				(function repeat(count){
					console.info("repeat");
					if (!app.account) {
						// not logged in - Google SSO requires this
						redirect();
					}
					else {
						if (count < 50) {
							setTimeout(repeat, 100, ++count);
						}
					}
				})(0);
			}
			else {
				redirect();
			}
		} else {
			if (!suppress){
				loginMsg(data);
				console.error(data);
			}
		}
	}

	(function(){
		email = localStorage.getItem('email');
		token = localStorage.getItem('token');
	})();

	// facebook
	(function(d, s, id) {
		if (app.isServer) {
			var js, fjs = d.getElementsByTagName(s)[0];
			js = d.createElement(s);
			js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=737706186279455";
			fjs.parentNode.insertBefore(js, fjs);
		}
	}(document, 'script', 'facebook-jssdk'));
</script>

<script src="//apis.google.com/js/platform.js?onload=loginRenderButton" async defer></script>
<script>
if (app.isServer || app.isApp) {
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-35167620-1', 'auto');
	ga('send', 'pageview');
	if (app.isServer) {
		document.getElementById('social-login-wrap').style.display = 'block';
	}
}
// only try if not logged in
function notLoggedIn() {
	$("#login-modal").css({
		visibility: 'visible'
	});
	$("#logout").remove();
}

var guest = 0;
var initChannel = "usa-1";

(function(d, s, x){
	if (location.hostname === 'localhost' && location.hash !== '#test'){
		x = ".js";
		s = [
			'ui',
			'payment',
			'stats',
			'animate',
			'core',
			'title',
			'lobby',
			'ws',
			'audio',
			'map',
			'actions',
			'events',
			'ai'
		]
	}

	for (var i=0, len=s.length; i<len; i++){
		var e = d.createElement("script");
		var js = "js/" + s[i] + x + "?v="+ app.version;
		e.src = js;
		e.async = false;
		d.head.appendChild(e);
	}

})(document, ["firmament-wars"], ".min.js");
</script>
</html>