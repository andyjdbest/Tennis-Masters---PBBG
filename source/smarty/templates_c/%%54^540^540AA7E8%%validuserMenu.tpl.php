<?php /* Smarty version 2.6.26, created on 2010-07-28 22:36:34
         compiled from validuserMenu.tpl */ ?>
<div class="block-middle">
					<ul id="verticalmenu" class="glossymenu">
						<li><a href="overview.php">Home</a></li>
						<li><a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
">Academy</a>
							<ul>
								<li><a href="viewAcademy.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
">Academy Info</a></li>
								<li><a href="viewManagerInfo.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
">Manager Info</a></li>
								<li><a href="viewFixtures.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
">Fixtures</a></li>
								<li><a href="viewChallenges.php">Challenges</a></li>
								<li><a href="viewFinance.php">Finance</a></li>
							</ul>
						</li>
						<li><a href="viewLeague.php?league=<?php echo $this->_tpl_vars['idleague']; ?>
">League</a>
							<ul>
								<li><a href="viewLeague.php?league=<?php echo $this->_tpl_vars['idleague']; ?>
">Table</a></li>
								<li><a href="viewLeagueFixtures.php?league=<?php echo $this->_tpl_vars['idleague']; ?>
">Fixtures</a></li>
								
							</ul>
						</li>
                                                <li><a href="viewCountryDetails.php">Country</a>
							<ul>
								<li><a href="viewCountryDetails.php">Country Details</a></li>
							</ul>
						</li>   
						<li><a href="viewTransferMarket.php">Transfers</a>
							<ul>
								<li><a href="viewTransferMarket.php">Transfer Market</a></li>
								<li><a href="viewTransferredPlayers.php">My Transferred Players</a></li>
								<li><a href="viewGlobalTransfers.php">Recent Global Transfers</a></li>
							</ul>
						</li>
						<li><a href="viewTraining.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
">Training</a>
							<ul>
								<li><a href="viewTraining.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
">Training</a></li>
                                                                <li><a href="viewTrainingReport.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
">Report</a></li>
								<li><a href="viewCoaches.php?academy=<?php echo $this->_tpl_vars['idteam']; ?>
">Coaches</a></li>
							</ul>
						</li>
						<li><a href="search.php">Search</a>
						</li>
					</ul>
</div>