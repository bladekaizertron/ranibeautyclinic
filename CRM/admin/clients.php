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
                <button class="cg-primary-btn" id="add-client-btn">
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

    <!-- Add Client Modal -->
    <div id="add-client-modal" class="add-client-modal" style="display: none;">
        <div class="acm-overlay"></div>
        <div class="acm-container">
            <div class="acm-header">
                <div class="acm-title-area">
                    <span class="acm-subtitle">New Client Registration</span>
                    <h2 class="acm-title">Add Client Profile</h2>
                </div>
                <button class="acm-close-btn" onclick="closeAddClientModal()">
                    <i class='bx bx-x'></i>
                </button>
            </div>

            <form id="add-client-form" class="acm-form">
                <div class="acm-form-grid">
                    <!-- Required Fields -->
                    <div class="acm-form-group acm-full-width">
                        <label for="client-name">Full Name <span class="acm-required">*</span></label>
                        <input type="text" id="client-name" name="name" placeholder="Enter client's full name" required>
                    </div>

                    <div class="acm-form-group">
                        <label for="client-email">Email Address <span class="acm-required">*</span></label>
                        <input type="email" id="client-email" name="email" placeholder="client@example.com" required>
                    </div>

                    <div class="acm-form-group">
                        <label for="client-phone">Phone Number <span class="acm-required">*</span></label>
                        <input type="tel" id="client-phone" name="phone" placeholder="(123) 456-7890" required>
                    </div>

                    <!-- Optional Fields -->
                    <div class="acm-form-group acm-full-width">
                        <label for="client-address">Address</label>
                        <input type="text" id="client-address" name="address" placeholder="Street address, City, State, ZIP">
                    </div>

                    <div class="acm-form-group">
                        <label for="client-birthday">Birthday</label>
                        <input type="date" id="client-birthday" name="birthday">
                    </div>

                    <div class="acm-form-group">
                        <label for="client-gender">Gender</label>
                        <select id="client-gender" name="gender">
                            <option value="">Select gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                            <option value="Prefer not to say">Prefer not to say</option>
                        </select>
                    </div>

                    <div class="acm-form-group acm-full-width">
                        <label for="client-membership">Membership Status</label>
                        <div class="acm-membership-toggle">
                            <label class="acm-radio-option">
                                <input type="radio" name="membership_status" value="regular" checked>
                                <span class="acm-radio-label">
                                    <i class='bx bx-user'></i>
                                    Regular Client
                                </span>
                            </label>
                            <label class="acm-radio-option">
                                <input type="radio" name="membership_status" value="vip">
                                <span class="acm-radio-label">
                                    <i class='bx bxs-crown'></i>
                                    VIP Member
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="acm-form-group acm-full-width">
                        <label for="client-notes">Notes & Preferences</label>
                        <textarea id="client-notes" name="notes" rows="4" placeholder="Add any special notes, preferences, or allergies..."></textarea>
                    </div>
                </div>

                <div class="acm-footer">
                    <button type="button" class="acm-btn-secondary" onclick="closeAddClientModal()">
                        Cancel
                    </button>
                    <button type="submit" class="acm-btn-primary" id="save-client-btn">
                        <i class='bx bx-check'></i>
                        <span>Save Client</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast-notification" class="toast-notification"></div>
</div>
