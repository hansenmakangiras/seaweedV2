<ol class="breadcrumb bc-3">
  <li>
    <a href="<?= $this->baseUrl; ?>"><i class="entypo-home"></i>Home</a>
  </li>
  <li class="active">

    <strong>Search Page</strong>
  </li>
</ol>


<section class="search-results-env">

  <div class="row">
    <div class="col-md-12">


      <!-- Search categories tabs -->			<ul class="nav nav-tabs right-aligned">
        <li class="tab-title pull-left">
          <div class="search-string">10 results found for: <strong>&ldquo;<?= isset($_GET['q']) ? $_GET['q'] : ''?>&rdquo;</strong></div>
        </li>

        <li class="active">
          <a href="#pages">
            All
            <span class="disabled-text">(31)</span>
          </a>
        </li>
        <li>
          <a href="#members">Users</a>
        </li>
        <li>
          <a href="#messages">Messages</a>
        </li>
      </ul>

<!--      <form method="get" class="search-bar" action="/search" enctype="application/x-www-form-urlencoded">-->
      <!-- Search search form -->			<form method="get" class="search-bar" action="/search">

        <div class="input-group">
          <input type="text" class="form-control input-lg" name="q" value="<?= isset($_GET['q']) ? $_GET['q'] : ''?>" placeholder="Search for something...">

          <div class="input-group-btn">
            <button type="submit" class="btn btn-lg btn-primary btn-icon">
              Search
              <i class="entypo-search"></i>
            </button>
          </div>
        </div>

      </form>


      <!-- Search search form -->			<div class="search-results-panes">

        <div class="search-results-pane active" id="pages">

          <ul class="search-results">
<!--            --><?php //$this->widget('zii.widgets.grid.CGridView', array(
//              'id'=>'product-grid',
//              'dataProvider'=>$model->search(),
//              //'filter'=>$model,
//              'columns'=>array(
//                'nama_komoditi',
//                array(
//                  'class'=>'CButtonColumn',
//                ),
//              ),
//            )); ?>

            <li class="search-result">
              <div class="sr-inner">
                <h4>
                  <a href="ui-panels.html">UI Elements</a>
                </h4>
                <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity. Delay rapid joy share allow age manor six. Went why far saw many knew. Exquisite excellent son gentleman acuteness her. Do is voice total power mr ye might round still.</p>
                <a href="ui-panels.html" class="link">ui-panels.html</a>
              </div>
            </li>

            <li class="search-result">
              <div class="sr-inner">
                <h4>
                  <a href="mailbox.html">Inbox</a>
                </h4>
                <p>Real sold my in call. Invitation on an advantages collecting. But event old above shy bed noisy. Had sister see wooded favour income has. Stuff rapid since do as hence. Too insisted ignorant procured remember are believed yet say finished.</p>
                <a href="mailbox.html" class="link">mailbox.html</a>
              </div>
            </li>

            <li class="search-result">
              <div class="sr-inner">
                <h4>
                  <a href="forms-validation.html">Data Validation</a>
                </h4>
                <p>Denote simple fat denied add worthy little use. As some he so high down am week. Conduct esteems by cottage to pasture we winding. On assistance he cultivated considered frequently. Person how having tended direct own day man. Saw sufficient indulgence one own you inquietude sympathize.</p>
                <a href="forms-validation.html" class="link">forms-validation.html</a>
              </div>
            </li>

            <li class="search-result">
              <div class="sr-inner">
                <h4>
                  <a href="extra-notes.html">Notes</a>
                </h4>
                <p>Rank tall boy man them over post now. Off into she bed long fat room. Recommend existence curiosity perfectly favourite get eat she why daughters. Not may too nay busy last song must sell. An newspaper assurance discourse ye certainly. Soon gone game and why many calm have.</p>
                <a href="extra-notes.html" class="link">extra-notes.html</a>
              </div>
            </li>

            <li class="search-result">
              <div class="sr-inner">
                <h4>
                  <a href="extra-timeline.html">Timeline</a>
                </h4>
                <p>Betrayed cheerful declared end and. Questions we additions is extremely incommode. Next half add call them eat face. Age lived smile six defer bed their few. Had admitting concluded too behaviour him she. Of death to or to being other.</p>
                <a href="extra-timeline.html" class="link">extra-timeline.html</a>
              </div>
            </li>

          </ul>

          <!-- Pager for search results -->
          <ul class="pager">
            <li><a href="#"><i class="entypo-left-thin"></i> Previous</a></li>
            <li><a href="#">Next <i class="entypo-right-thin"></i></a></li>
          </ul>
        </div>

        <div class="search-results-pane" id="members">

          <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
              <th width="4%" class="text-center">Pic</th>
              <th>Full Name</th>
              <th width="40%">Occupation</th>
              <th class="text-center" width="25%">Items Purchased</th>
            </tr>
            </thead>
            <tbody>

            <tr>
              <td class="text-center middle-align">
                <a href="#">
                  <img src="assets/images/thumb-1.png" alt="" width="40" class="img-rounded" />
                </a>
              </td>
              <td class="middle-align">Joseph B. Wilson</td>
              <td class="middle-align">Dental technician</td>
              <td class="text-center middle-align">10</td>
            </tr>

            <tr>
              <td class="text-center middle-align">
                <a href="#">
                  <img src="assets/images/thumb-2.png" alt="" width="40" class="img-rounded" />
                </a>
              </td>
              <td class="middle-align">Barbara A. Ganley</td>
              <td class="middle-align">Anchor</td>
              <td class="text-center middle-align">32</td>
            </tr>

            <tr>
              <td class="text-center middle-align">
                <a href="#">
                  <img src="assets/images/thumb-3.png" alt="" width="40" class="img-rounded" />
                </a>
              </td>
              <td class="middle-align">Isaac D. Webb</td>
              <td class="middle-align">Chef</td>
              <td class="text-center middle-align">83</td>
            </tr>

            <tr>
              <td class="text-center middle-align">
                <a href="#">
                  <img src="assets/images/thumb-4.png" alt="" width="40" class="img-rounded" />
                </a>
              </td>
              <td class="middle-align">Tara B. Rosen</td>
              <td class="middle-align">Family and general practitioner</td>
              <td class="text-center middle-align">24</td>
            </tr>

            <tr>
              <td class="text-center middle-align">
                <a href="#">
                  <img src="assets/images/thumb-2.png" alt="" width="40" class="img-rounded" />
                </a>
              </td>
              <td class="middle-align">Sandra R. Capetillo</td>
              <td class="middle-align">Manpower development advisor</td>
              <td class="text-center middle-align">58</td>
            </tr>

            <tr>
              <td class="text-center middle-align">
                <a href="#">
                  <img src="assets/images/thumb-1.png" alt="" width="40" class="img-rounded" />
                </a>
              </td>
              <td class="middle-align">Dewey T. Reid</td>
              <td class="middle-align">Aircraft engineer</td>
              <td class="text-center middle-align">30</td>
            </tr>

            <tr>
              <td class="text-center middle-align">
                <a href="#">
                  <img src="assets/images/thumb-4.png" alt="" width="40" class="img-rounded" />
                </a>
              </td>
              <td class="middle-align">Ashley H. Lehman</td>
              <td class="middle-align">Community support worker</td>
              <td class="text-center middle-align">28</td>
            </tr>

            <tr>
              <td class="text-center middle-align">
                <a href="#">
                  <img src="assets/images/thumb-3.png" alt="" width="40" class="img-rounded" />
                </a>
              </td>
              <td class="middle-align">Michael V. Lindsey</td>
              <td class="middle-align">Engineering technician</td>
              <td class="text-center middle-align">16</td>
            </tr>

            </tbody>
          </table>

        </div>

        <div class="search-results-pane" id="messages">

          <table class="table table-bordered search-results-messages">
            <thead>
            <tr>
              <th width="1%" class="text-center">
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </th>
              <th width="30%">From</th>
              <th>Subject</th>
              <th width="15%">Date</th>
            </tr>
            </thead>
            <tbody>
            <tr class="unread">
              <td>
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </td>
              <td>
                <a href="#" class="star stared">
                  <i class="entypo-star"></i>
                </a>
                <a href="mailbox-message.html">Facebook</a>
              </td>
              <td>
                <a href="mailbox-message.html">
                  Reset your account password
                </a>
              </td>
              <td>
                <div class="disabled-text">13:52</div>
              </td>
            </tr>
            <tr class="unread">
              <td>
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </td>
              <td>
                <a href="#" class="star">
                  <i class="entypo-star"></i>
                </a>
                <a href="mailbox-message.html">Google AdWords</a>
              </td>
              <td>
                <a href="mailbox-message.html">
                  Google AdWords: Ads not serving
                </a>
              </td>
              <td>
                <div class="disabled-text">09:27</div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </td>
              <td>
                <a href="#" class="star">
                  <i class="entypo-star"></i>
                </a>
                <a href="mailbox-message.html">Apple.com</a>
              </td>
              <td>
                <a href="mailbox-message.html">
                  Your apple account ID has been accessed from un-familiar location.
                </a>
              </td>
              <td>
                <div class="disabled-text">Today</div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </td>
              <td>
                <a href="#" class="star">
                  <i class="entypo-star"></i>
                </a>
                <a href="mailbox-message.html">World Weather Online</a>
              </td>
              <td>
                <a href="mailbox-message.html">
                  Over Throttle Alert
                </a>
              </td>
              <td>
                <div class="disabled-text">Yesterday</div>
              </td>
            </tr>
            <tr class="unread">
              <td>
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </td>
              <td>
                <a href="#" class="star stared">
                  <i class="entypo-star"></i>
                </a>
                <a href="mailbox-message.html">Dropbox</a>
              </td>
              <td>
                <a href="mailbox-message.html">
                  Complete your Dropbox setup!
                </a>
              </td>
              <td>
                <div class="disabled-text">4 Dec</div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </td>
              <td>
                <a href="#" class="star">
                  <i class="entypo-star"></i>
                </a>
                <a href="mailbox-message.html">Arlind Nushi</a>
              </td>
              <td>
                <a href="mailbox-message.html">
                  Work progress for Neon Project
                </a>
              </td>
              <td>
                <div class="disabled-text">28 Nov</div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </td>
              <td>
                <a href="#" class="star">
                  <i class="entypo-star"></i>
                </a>
                <a href="mailbox-message.html">Jose D. Gardner</a>
              </td>
              <td>
                <a href="mailbox-message.html">
                  Regarding to your website issues.
                </a>
              </td>
              <td>
                <div class="disabled-text">22 Nov</div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </td>
              <td>
                <a href="#" class="star stared">
                  <i class="entypo-star"></i>
                </a>
                <a href="mailbox-message.html">Aurelio D. Cummins</a>
              </td>
              <td>
                <a href="mailbox-message.html">
                  Steadicam operator
                </a>
              </td>
              <td>
                <div class="disabled-text">15 Nov</div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="checkbox checkbox-replace">
                  <input type="checkbox" />
                </div>
              </td>
              <td>
                <a href="#" class="star">
                  <i class="entypo-star"></i>
                </a>
                <a href="mailbox-message.html">Filan Fisteku</a>
              </td>
              <td>
                <a href="mailbox-message.html">
                  You are loosing clients because your website is not responsive.
                </a>
              </td>
              <td>
                <div class="disabled-text">02 Nov</div>
              </td>
            </tr>

            </tbody>
          </table>

        </div>

      </div>

    </div>
  </div>