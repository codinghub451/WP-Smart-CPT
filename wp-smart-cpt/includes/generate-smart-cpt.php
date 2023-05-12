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