<h1>Settings</h1>

<section class="cpt-details">
    <div class="cpt-tabs">
        <ul id="tabs-nav">
            <li><a href="#tab1">Generate Smart CPT</a></li>
            <li><a href="#tab2">All Smart CPTs</a></li>
            <li><a href="#tab3">About Smart CPT</a></li>
        </ul> <!-- END tabs-nav -->
        <div id="tabs-content">
            <div id="tab1" class="tab-content">
                <section class="cpt-creation">
                    <div class="content">
                        <h2>Generate Smart CPT</h2>
                        <form>
                            <input type="text" value="" id="cpt-pname" placeholder="Enter CPT name" />
                            <input type="text" value="" id="cpt-sname" placeholder="Enter Singular name" />
                            <textarea id="cpt-description" value="" placeholder="Add Description" rows="4" cols="50"></textarea>
                            <div class="select-icons">
                                <select id="dashicons-select">
                                    <option value="" disabled selected hidden>Choose a CPT Icon</option>
                                    <option value="dashicons-search">Search</option>
                                    <option value="dashicons-admin-site">Admin Site</option>
                                    <option value="dashicons-dashboard">Dashboard</option>
                                    <option value="dashicons-testimonial">Testimonial</option>
                                    <option value="dashicons-portfolio">Portfolio</option>
                                    <option value="dashicons-category">Category</option>
                                    <option value="dashicons-pressthis">PressThis</option>
                                    <option value="dashicons-performance">Performance</option>
                                    <option value="dashicons-wordpress">WordPress</option>
                                    <option value="dashicons-menu">Menu</option>
                                </select>
                                <div id="selected-dashicon"><b>Selected Icon:</b>
                                    <p></p>
                                </div>
                            </div>
                            <button type="button" id="create-cpt">Create CPT</button>
                            <span id="success-message"></span>
                        </form>
                    </div>
                </section>
            </div>
            <div id="tab2" class="tab-content">
                <h2>All Details</h2>
                <div id="custom-post-types-list"></div>
            </div>
            <div id="tab3" class="tab-content">
                <h2>Custom Post Type Generator</h2>
                <h3>Introduction</h3>
                <p>The Custom Post Type Creator plugin allows users to easily create custom post types in WordPress without having to write any code. Simply enter the name of your custom post type, and the plugin takes care of the rest.</p>
                <h3>Creating Custom Post Types</h3>
                <h4>Enter the Name of Your Custom Post Type</h4>
                <p>To create a custom post type, simply enter the name of your post type into the field provided on the plugin's menu page. The plugin will automatically generate the necessary code to create the post type.</p>
                <h4>Customizing Your Post Type</h4>
                <p>If you want to customize your post type beyond the basic settings, the plugin provides a number of options to help you do so. You can choose the labels for your post type, set up custom fields, and more.</p>
                <h3>Displaying Custom Post Types</h3>
                <h4>Using the Shortcode</h4>
                <p>Once you've created a custom post type, you can display all posts for that post type on any page or post on your site using a shortcode. Simply copy and paste the shortcode provided by the plugin, and all posts for that custom post type will be displayed.</p>
                <h4>Displaying Posts in a Table</h4>
                <p>The plugin also provides the option to display posts for a custom post type in a table format. This makes it easy for users to view all posts for a specific post type at once.</p>
                <h3>Deleting Custom Post Types</h3>
                <p>If you decide you no longer need a custom post type, the plugin provides a simple way to delete it. Simply click the delete button next to the post type you want to remove, and the plugin takes care of the rest.</p>
                <h3>Conclusion</h3>
                <p>With the Custom Post Type Creator plugin, creating and managing custom post types in WordPress has never been easier. Whether you're a developer or a non-technical user, this plugin makes it simple to create and manage custom post types with just a few clicks.</p>

            </div>
        </div> <!-- END tabs-content -->
    </div> <!-- END tabs -->
</section>