<!-- sidebar  -->
<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="<?= site_url('home') ?>"><img src="<?= base_url('img/') ?>logo.png" alt=""></a>
        <a class="small_logo" href="<?= site_url('home') ?>"><img src="<?= base_url('img/') ?>mini_logo.png" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="<?= base_url('img/') ?>menu-icon/dashboard.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>User Management </span>
                </div>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/index_2') ?>">Default</a></li>
              <li><a href="<?= site_url('admin/index_3') ?>">Dark Sidebar</a></li>
              <li><a href="<?= site_url('home') ?>">Light Sidebar</a></li>
            </ul>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="<?= base_url('img/') ?>menu-icon/2.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Application </span>
                </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/editor') ?>">editor</a></li>
              <li><a href="<?= site_url('admin/mail_box') ?>">Mail Box</a></li>
              <li><a href="<?= site_url('admin/chat') ?>">Chat</a></li>
              <li><a href="<?= site_url('admin/faq') ?>">FAQ</a></li>
            </ul>
        </li>
        <li class="">
            <a href="<?= site_url('admin/user_support') ?>" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="<?= base_url('img/') ?>menu-icon/8.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>User Support</span>
                </div>
            </a>
        </li>
        <li class="">
            <a href="<?= site_url('admin/agent_tickets') ?>" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="<?= base_url('img/') ?>menu-icon/6.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Manage Tickets</span>
                </div>
            </a>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/3.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Pages</span>
            </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/login') ?>">Login</a></li>
              <li><a href="<?= site_url('admin/resister') ?>">Register</a></li>
              <li><a href="<?= site_url('admin/error_400') ?>">Error 404</a></li>
              <li><a href="<?= site_url('admin/error_500') ?>">Error 500</a></li>
              <li><a href="<?= site_url('admin/forgot_pass') ?>">Forgot Password</a></li>
              <li><a href="<?= site_url('admin/gallery') ?>">Gallery</a></li>
            </ul>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/4.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Admins</span>
            </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/admin_list') ?>">Admin List</a></li>
              <li><a href="<?= site_url('admin/add_new_admin') ?>">Add New Admin</a></li>
            </ul>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/11.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Role &amp; Permissions</span>
            </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/module_setting') ?>">Module Setting</a></li>
              <li><a href="<?= site_url('admin/role_permissions') ?>">Role &amp; Permissions</a></li>
            </ul>
        </li>
        <li class="">
            <a  href="<?= site_url('admin/navs') ?>" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/12.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Navs</span>
            </div>
            </a>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/5.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Users</span>
            </div>
            </a>
            <ul>
              <li><a href="<?= site_url('home/userList') ?>">Users List</a></li>
              <li><a href="<?= site_url('home/addUser') ?>">Add New User</a></li>
            </ul>
        </li>
        <li>
            <a href="<?= site_url('admin/Builder') ?>" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="<?= base_url('img/') ?>menu-icon/6.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Builder </span>
                </div>
            </a>
        </li>
        <li class="">
            <a  href="<?= site_url('admin/invoice') ?>" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/7.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Invoice</span>
            </div>
            </a>
        </li>
        <li class="">
            <a  class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="<?= base_url('img/') ?>menu-icon/8.svg" alt="">
              </div>
              <div class="nav_title">
                  <span>forms</span>
              </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/Basic_Elements') ?>">Basic Elements</a></li>
              <li><a href="<?= site_url('admin/Groups') ?>">Groups</a></li>
              <li><a href="<?= site_url('admin/Max_Length') ?>">Max Length</a></li>
              <li><a href="<?= site_url('admin/Layouts') ?>">Layouts</a></li>
            </ul>
          </li>
          <li class="">
              <a href="<?= site_url('admin/Board') ?>" aria-expanded="false">
                  <div class="nav_icon_small">
                      <img src="<?= base_url('img/') ?>menu-icon/9.svg" alt="">
                  </div>
                  <div class="nav_title">
                      <span>Board</span>
                  </div>
              </a>
          </li>
        <li class="">
            <a  href="<?= site_url('admin/calender') ?>" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/10.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Calander</span>
            </div>
            </a>
        </li>
        <li class="">
            <a  class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="<?= base_url('img/') ?>menu-icon/11.svg" alt="">
              </div>
              <div class="nav_title">
                  <span>Themes</span>
              </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/dark_sidebar') ?>">Dark Sidebar</a></li>
              <li><a href="<?= site_url('admin/light_sidebar') ?>">light Sidebar</a></li>
            </ul>
        </li>
        <li class="">
            <a  class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="<?= base_url('img/') ?>menu-icon/12.svg" alt="">
              </div>
              <div class="nav_title">
                  <span>General</span>
              </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/Minimized_Aside') ?>">Minimized Aside</a></li>
              <li><a href="<?= site_url('admin/empty_page') ?>">Empty page</a></li>
              <li><a href="<?= site_url('admin/fixed_footer') ?>">Fixed Footer</a></li>
            </ul>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
            <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/13.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Products</span>
            </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/Products') ?>">Products</a></li>
              <li><a href="<?= site_url('admin/Product_Details') ?>">Product Details</a></li>
              <li><a href="<?= site_url('admin/Cart') ?>">Cart</a></li>
              <li><a href="<?= site_url('admin/Checkout') ?>">Checkout</a></li>
            </ul>
          </li>
        <li class="">
          <a   class="has-arrow" href="#" aria-expanded="false">
            <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/14.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Icons</span>
            </div>
          </a>
          <ul>
            <li><a href="<?= site_url('admin/Fontawesome_Icon') ?>">Fontawesome Icon</a></li>
            <li><a href="<?= site_url('admin/themefy_icon') ?>">themefy icon</a></li>
          </ul>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="<?= base_url('img/') ?>menu-icon/15.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Animations</span>
                </div>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/wow_animation') ?>">Animate</a></li>
                <li><a href="<?= site_url('admin/Scroll_Reveal') ?>">Scroll Reveal</a></li>
                <li><a href="<?= site_url('admin/tilt') ?>">Tilt Animation</a></li>
                
            </ul>
          </li>
          <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="<?= base_url('img/') ?>menu-icon/16.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Components</span>
                </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/accordion') ?>">Accordions</a></li>
              <li><a href="<?= site_url('admin/Scrollable') ?>">Scrollable</a></li>
              <li><a href="<?= site_url('admin/notification') ?>">Notifications</a></li>
              <li><a href="<?= site_url('admin/carousel') ?>">Carousel</a></li>
              <li><a href="<?= site_url('admin/Pagination') ?>">Pagination</a></li>
            </ul>
          </li>

          <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="<?= base_url('img/') ?>menu-icon/17.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Table</span>
                </div>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/data_table') ?>">Data Tables</a></li>
                <li><a href="<?= site_url('admin/student-data') ?>">Student Table</a></li>
                <li><a href="<?= site_url('admin/bootstrap_table') ?>">Bootstrap</a></li>
            </ul>
          </li>
          <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="<?= base_url('img/') ?>menu-icon/18.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Cards</span>
                </div>
            </a>
            <ul>
                <li><a href="<?= site_url('admin/basic_card') ?>">Basic Card</a></li>
                <li><a href="<?= site_url('admin/theme_card') ?>">Theme Card</a></li>
                <li><a href="<?= site_url('admin/dargable_card') ?>">Draggable Card</a></li>
            </ul>
          </li>


        <li class="">
          <a   class="has-arrow" href="#" aria-expanded="false">
            <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/19.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Charts</span>
            </div>
          </a>
          <ul>
            <li><a href="<?= site_url('admin/chartjs') ?>">ChartJS</a></li>
            <li><a href="<?= site_url('admin/apex_chart') ?>">Apex Charts</a></li>
            <li><a href="<?= site_url('admin/chart_sparkline') ?>">Chart sparkline</a></li>
            <li><a href="<?= site_url('admin/am_chart') ?>">am-charts</a></li>
            <li><a href="<?= site_url('admin/nvd3_charts') ?>">nvd3 charts.</a></li>
          </ul>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="<?= base_url('img/') ?>menu-icon/20.svg" alt="">
              </div>
              <div class="nav_title">
                  <span>UI Kits </span>
              </div>
            </a>
            <ul>
              <li><a href="<?= site_url('admin/colors') ?>">colors</a></li>
              <li><a href="<?= site_url('admin/Alerts') ?>">Alerts</a></li>
              <li><a href="<?= site_url('admin/buttons') ?>">Buttons</a></li>
              <li><a href="<?= site_url('admin/modal') ?>">modal</a></li>
              <li><a href="<?= site_url('admin/dropdown') ?>">Droopdowns</a></li>
              <li><a href="<?= site_url('admin/Badges') ?>">Badges</a></li>
              <li><a href="<?= site_url('admin/Loading_Indicators') ?>">Loading Indicators</a></li>
              <li><a href="<?= site_url('admin/color_plate') ?>">Color Plate</a></li>
              <li><a href="<?= site_url('admin/typography') ?>">Typography</a></li>
              <li><a href="<?= site_url('admin/datepicker') ?>">Date Picker</a></li>
            </ul>
          </li>

        <li class="">
          <a   class="has-arrow" href="#" aria-expanded="false">
            <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/21.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Widgets</span>
            </div>
          </a>
          <ul>
            <li><a href="<?= site_url('admin/chart_box_1') ?>">Chart Boxes 1</a></li>
            <li><a href="<?= site_url('admin/profilebox') ?>">Profile Box</a></li>
          </ul>
        </li>
        

        <li class="">
          <a   class="has-arrow" href="#" aria-expanded="false">
            <div class="nav_icon_small">
                <img src="<?= base_url('img/') ?>menu-icon/12.svg" alt="">
            </div>
            <div class="nav_title">
                <span>Maps</span>
            </div>
          </a>
          <ul>
            <li><a href="<?= site_url('admin/mapjs') ?>">Maps JS</a></li>
            <li><a href="<?= site_url('admin/vector_map') ?>">Vector Maps</a></li>
          </ul>
        </li>


      </ul>
</nav>
 <!--/ sidebar  -->
