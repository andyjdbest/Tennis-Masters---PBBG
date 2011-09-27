<ul id="nav">
						<li><a href="index.php">General</a>
                                                    <ul>
                                                                 <li><a href="index.php">HomePage</a></li>
								 <li><a href="profile.php">Profile</a> </li>
                                                                 <li><a href="search.php">Search</a></li>
								 <li><a href="http://dt-games.net/gamesetmatch/index.php?board=14.0" target="_blank">Beta Testing Forum</a></li>
					                         <li><a href="help.php">Help</a></li>
                                                                 <li><a href="viewCalendar.php">Weekly Calendar</a></li>
								<li>----------------------------</li>
                                                               <li><a class="logout" href="logout.php">Log out</a></li>  

                                                     </ul>
                                                 </li>

						<li><a href="viewAcademy.php?academy={$idteam}">Academy</a>
							<ul>
								<li><a href="viewAcademy.php?academy={$idteam}">Academy Info</a></li>
								<li><a href="viewManagerInfo.php?user={$userid}">Manager Info</a></li>
								<li><a href="viewFixtures.php?academy={$idteam}">My Fixtures</a></li>
								<li><a href="viewChallenges.php">Challenges</a></li>
                                                                <li><a href="viewFinance.php">Finance</a></li>
                                                                 <li><a href="viewStadium.php?academy={$idteam}">Stadium</a>   
                                                                <li><a href="viewTraining.php?academy={$idteam}">Training</a>
							         <ul>
								   <li><a href="viewTraining.php?academy={$idteam}">Training</a></li>
                                                                   <li><a href="viewTrainingReport.php?academy={$idteam}">Report</a></li>
								   <li><a href="viewCoaches.php?academy={$idteam}">Coaches</a></li>
							         </ul>
						               </li> 
							</ul>
						</li>
						<li><a href="viewLeague.php?league={$idleague}">Matches</a>
						<ul>
							<li><a href="viewLeague.php?league={$idleague}">League</a>
								<ul>
									<li><a href="viewLeague.php?league={$idleague}">Table</a></li>
									<li><a href="viewLeagueFixtures.php?league={$idleague}">Fixtures</a></li>
								</ul>
							</li>
							<li><a href="viewCup.php?cup=0">KnockOut Cups</a>
								<ul>
									<li><a href="viewCup.php?cup=4">Amazing Cup</a></li>
								</ul>
							</li>
						</ul>
						</li>
                        <li><a href="viewCountryDetails.php">World</a>
							<ul>
								<li><a href="viewCountryDetails.php">Country Details</a></li>
								<li><a href="viewAlliances.php">Alliances</a></li>	
							</ul>
						</li>   
						<li><a href="viewTransferMarket.php">Transfers</a>
							<ul>
								<li><a href="viewTransferMarket.php">Transfer Market</a></li>
								<li><a href="viewTransferredPlayers.php">My Transferred Players</a></li>
								<li><a href="viewGlobalTransfers.php">Recent Global Transfers</a></li>
							</ul>
						</li>
						{if $cManager ne 0}
						<li>
							<a href="countryManager.php?cID={$cManager}">Country Manager</a> 
						</li>
						{/if}
						{if $member ne 0}
						<li>
							<a href="membershipFeatures.php">Membership</a> 
						</li>
						{/if}
                        <li>
							{if $new_mail ne 0}
					         <a href="mail.php?type=inbox">Mail ({$new_mail})</a> 
					              {else}
					        <a href="mail.php?type=inbox">Mail</a>
					        {/if} 
                        </li>  

						
						
					</ul>