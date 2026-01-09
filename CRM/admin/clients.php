<!-- Clients Section: Ultra-Premium Portfolio View -->
<div id="clients-section" class="main-section" style="display: none;">
    <div class="clients-glass-header">
        <div class="cg-header-top">
            <div class="cg-title-area">
                <span class="cg-subtitle">Rani Beauty Clinic</span>
                <h1 class="cg-title">Exquisite Directory</h1>
                <p class="cg-count"><span id="client-total-count">0</span> Registered Clients</p>
            </div>
            <div class="cg-actions">
                <button class="cg-action-btn" title="Export Data"><i class='bx bx-export'></i></button>
                <button class="cg-action-btn" title="Merge Directory"><i class='bx bx-git-merge'></i></button>
                <button class="cg-primary-btn">
                    <i class='bx bx-plus'></i>
                    <span>Add New Client</span>
                </button>
            </div>
        </div>

        <div class="cg-header-bottom">
            <div class="cg-search-bar">
                <i class='bx bx-search'></i>
                <input type="text" id="clients-search-input" placeholder="Search by name, contact or email signature...">
            </div>
            <div class="cg-filter-tabs">
                <div class="cg-filter-tab active" data-filter="all">All Clients</div>
                <div class="cg-filter-tab" data-filter="recent">Recent Visits</div>
                <div class="cg-filter-tab" data-filter="vip">Membership</div>
                <div class="cg-filter-tab" data-filter="inactive">Dormant</div>
            </div>
            <div class="cg-view-toggles">
                <button class="view-toggle active" id="view-grid" title="Portfolio Grid"><i class='bx bx-grid-alt'></i></button>
                <button class="view-toggle" id="view-list" title="Compact List"><i class='bx bx-list-ul'></i></button>
            </div>
        </div>
    </div>

    <div class="clients-content-area">
        <!-- Grid View Container -->
        <div id="clients-portfolio-grid" class="clients-grid">
            <!-- Dynamic cards will be injected here -->
            <div class="cg-loading-state">
                <div class="cg-spinner"></div>
                <p>Curating your client directory...</p>
            </div>
        </div>

        <!-- List View Container (Hidden by default) -->
        <div id="clients-focus-list" class="clients-list" style="display: none;">
            <div class="cg-list-header">
                <div class="col-client">Client Signature</div>
                <div class="col-status">Status</div>
                <div class="col-phone">Contact</div>
                <div class="col-email">Email Address</div>
                <div class="col-actions">Actions</div>
            </div>
            <div id="clients-list-body" class="cg-list-body">
                <!-- Dynamic rows will be injected here -->
            </div>
        </div>
    </div>
</div>
