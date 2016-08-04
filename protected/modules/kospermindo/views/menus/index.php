<div class="row">

  <div class="col-sm-6">

    <div class="panel panel-primary" data-collapsed="0">

      <div class="panel-heading">
        <div class="panel-title">
          Custom Drag Button
        </div>

        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
        </div>
      </div>

      <div class="panel-body">

        <div id="list-2" class="nested-list dd with-margins custom-drag-button">
          <!-- adding class "custom-drag-button" will create specific handler for dragging list items -->
          <ul class="dd-list">

            <li class="dd-item">
              <div class="dd-handle">
                <span>.</span>
                <span>.</span>
                <span>.</span>
              </div>

              <div class="dd-content">
                List element 1
              </div>

              <ul class="dd-list">

                <li class="dd-item">
                  <div class="dd-handle">
                    <span>.</span>
                    <span>.</span>
                    <span>.</span>
                  </div>

                  <div class="dd-content">
                    Sub list element 1
                  </div>
                </li>

                <li class="dd-item">
                  <div class="dd-handle">
                    <span>.</span>
                    <span>.</span>
                    <span>.</span>
                  </div>

                  <div class="dd-content">
                    Sub list element 2
                  </div>

                  <ul class="dd-list">

                    <li class="dd-item">
                      <div class="dd-handle">
                        <span>.</span>
                        <span>.</span>
                        <span>.</span>
                      </div>

                      <div class="dd-content">
                        Sub list element 2.1
                      </div>
                    </li>

                    <li class="dd-item">
                      <div class="dd-handle">
                        <span>.</span>
                        <span>.</span>
                        <span>.</span>
                      </div>

                      <div class="dd-content">
                        Sub list element 2.2
                      </div>
                    </li>

                  </ul>

                </li>

                <li class="dd-item">
                  <div class="dd-handle">
                    <span>.</span>
                    <span>.</span>
                    <span>.</span>
                  </div>

                  <div class="dd-content">
                    Sub list element 3
                  </div>
                </li>

              </ul>
            </li>

            <li class="dd-item">
              <div class="dd-handle">
                <span>.</span>
                <span>.</span>
                <span>.</span>
              </div>

              <div class="dd-content">
                List element 2
              </div>
            </li>

            <li class="dd-item">
              <div class="dd-handle">
                <span>.</span>
                <span>.</span>
                <span>.</span>
              </div>

              <div class="dd-content">
                List element 3
              </div>
            </li>

            <li class="dd-item">
              <div class="dd-handle">
                <span>.</span>
                <span>.</span>
                <span>.</span>
              </div>

              <div class="dd-content">
                List element 4
              </div>
            </li>

            <li class="dd-item">
              <div class="dd-handle">
                <span>.</span>
                <span>.</span>
                <span>.</span>
              </div>

              <div class="dd-content">
                List element 5
              </div>
            </li>
          </ul>

        </div>

      </div>

    </div>


  </div>
</div>
<?php
 Yii::app()->clientScript->registerScript('nested','
 $(".dd").nestable({});
  ', CClientScript::POS_READY);
?>