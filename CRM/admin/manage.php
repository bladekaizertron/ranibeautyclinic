<!-- Manage Section (hidden by default) -->
<div id="manage-section" class="main-section" style="display: none;">
    <div class="head-title">
        <div class="left">
            <h1>Manage</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Manage</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <!-- Schedule subsection (default) -->
        <div class="manage-subsection" id="manage-schedule" style="width: 100%;">
            <div class="schedule-calendar-container">
                <div class="schedule-toolbar">
                    <div class="schedule-tabs">
                        <div class="schedule-tab active">Staff</div>
                        <div class="schedule-tab">Resources</div>
                    </div>

                    <div class="schedule-controls">
                        <div class="search-staff-wrapper">
                            <i class='bx bx-search'></i>
                            <input type="text" placeholder="Search by staff">
                        </div>

                        <div class="date-navigator">
                            <span class="date-range-text" id="sched-date-range">Jan 4 - Jan 10, 2026</span>
                            <i class='bx bx-chevron-down' style="color: #666;"></i>
                            <div class="nav-arrows">
                                <button class="nav-arrow" id="sched-prev-week"><i class='bx bx-chevron-left'></i></button>
                                <button class="nav-arrow" id="sched-next-week"><i class='bx bx-chevron-right'></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="schedule-grid-wrapper" style="overflow-x: auto;">
                    <table class="schedule-grid-table">
                        <thead>
                            <tr id="sched-table-days">
                                <th style="width: 200px; background: #fff; border: none;"></th>
                                <!-- Will be populated by JS -->
                            </tr>
                        </thead>
                        <tbody id="sched-table-body">
                            <!-- Will be populated by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Services subsection -->
        <div class="order manage-subsection" id="manage-services" style="display: none;">
            <div class="services-header">
                <h3>Services</h3>
                
                <div class="services-search">
                    <i class='bx bx-search'></i>
                    <input type="text" id="service-search-input" placeholder="Search for a service...">
                </div>

                <div class="services-filters">
                    <div class="filter-pill active" data-category="all">All</div>
                    <div class="filter-pill" data-category="Face Fixes">Face Fixes</div>
                    <div class="filter-pill" data-category="Body Fixes">Body Fixes</div>
                    <div class="filter-pill" data-category="Skin Fixes">Skin Fixes</div>
                    <div class="filter-pill" data-category="Laser Hair Removal">Laser Hair</div>
                    <div class="filter-pill" data-category="Radiofrequency Microneedling">RF Microneedling</div>
                    <div class="filter-pill" data-category="Hydrafacial">Hydrafacial</div>
                    <div class="filter-pill" data-category="Chemical Peels">Peels</div>
                    <div class="filter-pill" data-category="VI Peels">VI Peels</div>
                    <div class="filter-pill" data-category="Skin Boosters & Wellness">Wellness</div>
                    <div class="filter-pill" data-category="Add Ons">Add Ons</div>
                </div>
            </div>

            <div class="services-list">
                <!-- Face Fixes -->
                <div class="service-item" data-service="Botox / Botox Facial" data-category="Face Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Botox / Botox Facial</span>
                        <span class="service-category">Face Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$14</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <!-- ... many more service items ... -->
                <div class="service-item" data-service="Sculptra" data-category="Face Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Sculptra</span>
                        <span class="service-category">Face Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$950</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Lip Filler" data-category="Face Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Lip Filler</span>
                        <span class="service-category">Face Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$650</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Eye Filler" data-category="Face Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Eye Filler</span>
                        <span class="service-category">Face Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$750</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Cheek Filler" data-category="Face Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Cheek Filler</span>
                        <span class="service-category">Face Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$850</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Nose Filler" data-category="Face Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Nose Filler</span>
                        <span class="service-category">Face Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$795</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Jawline Filler" data-category="Face Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Jawline Filler</span>
                        <span class="service-category">Face Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$795</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Neck Filler" data-category="Face Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Neck Filler</span>
                        <span class="service-category">Face Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$795</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>

                <!-- Body Fixes -->
                <div class="service-item" data-service="Radiesse" data-category="Body Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Radiesse</span>
                        <span class="service-category">Body Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$950</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Sculptra Skinny BBL" data-category="Body Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Sculptra Skinny BBL</span>
                        <span class="service-category">Body Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$895</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Traptox" data-category="Body Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Traptox</span>
                        <span class="service-category">Body Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$895</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Cutera Secret" data-category="Body Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Cutera Secret</span>
                        <span class="service-category">Body Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$895</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Sofwave (Body)" data-category="Body Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Sofwave</span>
                        <span class="service-category">Body Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$495</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>

                <!-- Skin Fixes -->
                <div class="service-item" data-service="Laser Facials" data-category="Skin Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Laser Facials</span>
                        <span class="service-category">Skin Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$495</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Hydrafacial" data-category="Skin Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Hydrafacial</span>
                        <span class="service-category">Skin Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$250</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="VI Peel" data-category="Skin Fixes">
                    <div class="service-main-info">
                        <span class="service-title">VI Peel</span>
                        <span class="service-category">Skin Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$399</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Cosmelan" data-category="Skin Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Cosmelan</span>
                        <span class="service-category">Skin Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$995</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Sofwave (Skin)" data-category="Skin Fixes">
                    <div class="service-main-info">
                        <span class="service-title">Sofwave</span>
                        <span class="service-category">Skin Fixes</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$495</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>

                <!-- Laser Hair Removal -->
                <div class="service-item" data-service="Laser Acne Facial" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Laser Acne Facial</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$495</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Laser Roscea Facial" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Laser Roscea Facial</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$495</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Laser Resurfacing Facial" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Laser Resurfacing Facial</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$795</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Upper Lip Laser Hair Removal" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Upper Lip Laser Hair Removal</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$29</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Eyebrows" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Eyebrows</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Sideburns" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Sideburns</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Full Back" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Full Back</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$400</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Pantyline" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Pantyline</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$150</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Neck" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Neck</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$299</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Full Face Laser Hair Removal" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Full Face Laser Hair Removal</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$299</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Hands and fingers" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Hands and fingers</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Full Chest" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Full Chest</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$250</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Happy Trail" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Happy Trail</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Areolas" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Areolas</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Forehead" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Forehead</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Jawline" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Jawline</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Underarms" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Underarms</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$175</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Limited Time $99 Upper Lip" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Limited Time $99 Upper Lip</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Feet & Toes" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Feet & Toes</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Full Brazilian" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Full Brazilian</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$250</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Ears" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Ears</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Full Body Laser Hair Removal" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Full Body Laser Hair Removal</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$1299</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Pony Tail Laser" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Pony Tail Laser</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$125</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Full Abs" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Full Abs</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$300</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Full Legs" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Full Legs</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$450</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Cheeks" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Cheeks</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Chin" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Chin</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$99</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Buttocks" data-category="Laser Hair Removal">
                    <div class="service-main-info">
                        <span class="service-title">Buttocks</span>
                        <span class="service-category">Laser Hair Removal</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$299</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>

                <!-- Radiofrequency Microneedling -->
                <div class="service-item" data-service="Full Face" data-category="Radiofrequency Microneedling">
                    <div class="service-main-info">
                        <span class="service-title">Full Face</span>
                        <span class="service-category">Radiofrequency Microneedling</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$495</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Neck" data-category="Radiofrequency Microneedling">
                    <div class="service-main-info">
                        <span class="service-title">Neck</span>
                        <span class="service-category">Radiofrequency Microneedling</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$495</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Arms" data-category="Radiofrequency Microneedling">
                    <div class="service-main-info">
                        <span class="service-title">Arms</span>
                        <span class="service-category">Radiofrequency Microneedling</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$595</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Abdomen" data-category="Radiofrequency Microneedling">
                    <div class="service-main-info">
                        <span class="service-title">Abdomen</span>
                        <span class="service-category">Radiofrequency Microneedling</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$1100</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Bra Far Sculp" data-category="Radiofrequency Microneedling">
                    <div class="service-main-info">
                        <span class="service-title">Bra Far Sculp</span>
                        <span class="service-category">Radiofrequency Microneedling</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$695</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Legs" data-category="Radiofrequency Microneedling">
                    <div class="service-main-info">
                        <span class="service-title">Legs</span>
                        <span class="service-category">Radiofrequency Microneedling</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$1500</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>

                <!-- Hydrafacial -->
                <div class="service-item" data-service="Signature Hydrafacial" data-category="Hydrafacial">
                    <div class="service-main-info">
                        <span class="service-title">Signature Hydrafacial</span>
                        <span class="service-category">Hydrafacial</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$250</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Dior Hydrafacial" data-category="Hydrafacial">
                    <div class="service-main-info">
                        <span class="service-title">Dior Hydrafacial</span>
                        <span class="service-category">Hydrafacial</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$399</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Keravive Hydrafacial (Hair)" data-category="Hydrafacial">
                    <div class="service-main-info">
                        <span class="service-title">Keravive Hydrafacial (Hair)</span>
                        <span class="service-category">Hydrafacial</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$450</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Underarm Hydrafacial" data-category="Hydrafacial">
                    <div class="service-main-info">
                        <span class="service-title">Underarm Hydrafacial</span>
                        <span class="service-category">Hydrafacial</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$199</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Back Hydrafacial" data-category="Hydrafacial">
                    <div class="service-main-info">
                        <span class="service-title">Back Hydrafacial</span>
                        <span class="service-category">Hydrafacial</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$375</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>

                <!-- Chemical Peels -->
                <div class="service-item" data-service="BioRepeel" data-category="Chemical Peels">
                    <div class="service-main-info">
                        <span class="service-title">BioRepeel</span>
                        <span class="service-category">Chemical Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$295</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Face & Neck" data-category="Chemical Peels">
                    <div class="service-main-info">
                        <span class="service-title">Face & Neck</span>
                        <span class="service-category">Chemical Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$225</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Back" data-category="Chemical Peels">
                    <div class="service-main-info">
                        <span class="service-title">Back</span>
                        <span class="service-category">Chemical Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$275</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Underarms" data-category="Chemical Peels">
                    <div class="service-main-info">
                        <span class="service-title">Underarms</span>
                        <span class="service-category">Chemical Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$175</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Intimate Area" data-category="Chemical Peels">
                    <div class="service-main-info">
                        <span class="service-title">Intimate Area</span>
                        <span class="service-category">Chemical Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$195</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>

                <!-- VI Peels -->
                <div class="service-item" data-service="Acne VI Peel" data-category="VI Peels">
                    <div class="service-main-info">
                        <span class="service-title">Acne VI Peel</span>
                        <span class="service-category">VI Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$350</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Acne Scarring VI Peel" data-category="VI Peels">
                    <div class="service-main-info">
                        <span class="service-title">Acne Scarring VI Peel</span>
                        <span class="service-category">VI Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$350</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Rosacea Peel" data-category="VI Peels">
                    <div class="service-main-info">
                        <span class="service-title">Rosacea Peel</span>
                        <span class="service-category">VI Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$350</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Sensitive Skin Peel" data-category="VI Peels">
                    <div class="service-main-info">
                        <span class="service-title">Sensitive Skin Peel</span>
                        <span class="service-category">VI Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$350</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="VI Hyperpigmentation Peel" data-category="VI Peels">
                    <div class="service-main-info">
                        <span class="service-title">VI Hyperpigmentation Peel</span>
                        <span class="service-category">VI Peels</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$350</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>

                <!-- Skin Boosters and Wellness -->
                <div class="service-item" data-service="Salmon DNA" data-category="Skin Boosters & Wellness">
                    <div class="service-main-info">
                        <span class="service-title">Salmon DNA</span>
                        <span class="service-category">Skin Boosters & Wellness</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$450</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Exosomes" data-category="Skin Boosters & Wellness">
                    <div class="service-main-info">
                        <span class="service-title">Exosomes</span>
                        <span class="service-category">Skin Boosters & Wellness</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$595</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>

                <!-- Add Ons -->
                <div class="service-item" data-service="Hydrafacial Skin Booster" data-category="Add Ons">
                    <div class="service-main-info">
                        <span class="service-title">Hydrafacial Skin Booster</span>
                        <span class="service-category">Add Ons</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$75</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Dermaplanning" data-category="Add Ons">
                    <div class="service-main-info">
                        <span class="service-title">Dermaplanning</span>
                        <span class="service-category">Add Ons</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$70</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Red Light Therapy" data-category="Add Ons">
                    <div class="service-main-info">
                        <span class="service-title">Red Light Therapy</span>
                        <span class="service-category">Add Ons</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$50</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
                <div class="service-item" data-service="Blue Light Therapy" data-category="Add Ons">
                    <div class="service-main-info">
                        <span class="service-title">Blue Light Therapy</span>
                        <span class="service-category">Add Ons</span>
                    </div>
                    <div class="service-right">
                        <span class="service-price">$50</span>
                        <i class='bx bx-edit-alt service-actions'></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Staff subsection -->
        <div class="order manage-subsection" id="manage-staff" style="display: none;">
            <div class="head" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3>Staff</h3>
                </div>
                <button id="btn-new-staff" style="padding: 8px 16px; background: var(--dark); color: var(--light); border: none; border-radius: 4px; cursor: pointer;">
                    New staff
                </button>
            </div>

            <!-- Search and status filter -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin: 16px 0;">
                <div style="flex: 1; margin-right: 16px;">
                    <input type="text" placeholder="Search staff" style="width: 100%; padding: 10px 12px; border-radius: 4px; border: 1px solid var(--grey);">
                </div>
                <div>
                    <span style="margin-right: 4px;">Status:</span>
                    <select style="padding: 8px 12px; border-radius: 4px; border: 1px solid var(--grey);">
                        <option>Active</option>
                        <option>Invited</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Staff table -->
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Permission group</th>
                        <th>Invite</th>
                    </tr>
                </thead>
                <tbody id="manage-staff-table-body">
                    <!-- Populated by fetchStaffs() -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Sliding Service Profile Panel -->
<div id="service-profile-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.35); z-index:996;"></div>
<div id="service-profile-panel" style="position:fixed; top:0; right:-900px; width:900px; height:100%; background:var(--light); box-shadow:-2px 0 8px rgba(0,0,0,0.15); z-index:997; transition:right 0.3s ease; display:flex; flex-direction:column;">
    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px 20px; background:#222; color:#fff;">
        <div style="font-weight:600;">Service</div>
        <button id="service-profile-close" style="background:transparent; border:none; color:#fff; font-size:20px; cursor:pointer;">&times;</button>
    </div>
    <div style="padding:20px; overflow-y:auto; flex:1;">
        <h2 id="service-profile-name" style="margin:0 0 16px 0; font-size:22px;">Service Name</h2>

        <!-- Sub-tabs: Overview / Staff -->
        <div style="display:flex; gap:24px; border-bottom:1px solid var(--grey); margin-bottom:16px;">
            <button id="service-tab-overview" style="background:none; border:none; padding:8px 0; cursor:pointer; font-weight:600; border-bottom:2px solid #000;">
                Overview
            </button>
            <button id="service-tab-staff" style="background:none; border:none; padding:8px 0; cursor:pointer; color:var(--dark-grey); border-bottom:2px solid transparent;">
                Staff
            </button>
        </div>

        <div id="service-panel-overview">
            <!-- Commission and charges -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:24px;">
                <div>
                    <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey); display:block; margin-bottom:8px;">
                        Commission Override
                    </label>
                    <div style="display:flex; align-items:center; border-bottom:1px solid var(--grey); padding-bottom:8px;">
                        <input type="number" min="0" max="100" step="0.1" placeholder=""
                               style="flex:1; border:none; outline:none; font-size:16px; background:transparent;">
                        <span style="margin-left:4px;">%</span>
                    </div>
                </div>
                <div>
                    <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey); display:block; margin-bottom:8px;">
                        Business Service Charge *
                    </label>
                    <div style="display:flex; align-items:center; border-bottom:1px solid var(--grey); padding-bottom:8px;">
                        <span style="margin-right:6px;">$</span>
                        <input type="number" min="0" step="0.01" value="0.00"
                               style="flex:1; border:none; outline:none; font-size:16px; background:transparent; text-align:right;">
                    </div>
                </div>
            </div>

            <!-- Checkboxes -->
            <div style="display:flex; flex-direction:column; gap:12px; margin-bottom:24px; font-size:14px;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" style="width:16px; height:16px;">
                    <span>This location has a custom tax rate</span>
                </label>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" checked style="width:16px; height:16px;">
                    <span>Bookable online</span>
                </label>
            </div>

            <p style="font-size:14px; color:var(--dark-grey); line-height:1.5; margin-bottom:24px;">
                If this service has a custom commission rate, you may override it here.
                To use the default staff pay rate, leave this blank. Historical records will be preserved
                even if this value is changed.
            </p>
            <p style="font-size:14px; color:var(--dark-grey); line-height:1.5; margin-bottom:24px;">
                Business Service Charges may be used for material costs or other cost of goods recouped from
                this service. The total service charges may be seen in reports.
            </p>
            <p style="font-size:14px; color:var(--dark-grey); line-height:1.5; margin-bottom:24px;">
                A staff member must be assigned to this service for it to be accessible and appear in the
                self-booking overlay.
            </p>
        </div>

        <div id="service-panel-staff" style="display:none;">
            <table style="width:100%; border-collapse:collapse; margin-top:16px;">
                <thead>
                    <tr style="border-bottom:1px solid var(--grey);">
                        <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);"></th>
                        <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Price</th>
                        <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Duration</th>
                        <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Processing Time</th>
                        <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Finishing Time</th>
                        <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Transition Time</th>
                    </tr>
                </thead>
                <tbody id="service-panel-staff-body">
                    <!-- Dynamically populated -->
                </tbody>
            </table>
        </div>
    </div>
    <div style="padding:12px 20px; border-top:1px solid var(--grey); display:flex; justify-content:flex-end; gap:8px;">
        <button id="service-staff-save" style="padding:8px 14px; border:none; background:#000; color:#fff; border-radius:4px; cursor:pointer;">Save changes</button>
    </div>
</div>

<!-- Sliding Staff Profile Panel -->
<div id="staff-profile-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.35); z-index:998;"></div>
<div id="staff-profile-panel">
    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px 20px; background:#222; color:#fff; flex-shrink:0;">
        <div style="font-weight:600;">Staff Profile</div>
        <button id="staff-profile-close" style="background:transparent; border:none; color:#fff; font-size:20px; cursor:pointer;">&times;</button>
    </div>
    <div class="staff-profile-body">
        <div class="staff-profile-info-header">
            <h2 id="staff-profile-name" style="margin:0 0 16px 0; font-size:22px;">Staff Name</h2>

            <!-- Sub-tabs under Personal information -->
            <div style="display:flex; gap:24px; border-bottom:1px solid var(--grey); margin-bottom:0;">
                <button id="staff-tab-personal" class="staff-profile-tab active" style="background:none; border:none; padding:8px 0; cursor:pointer; font-weight:600; border-bottom:2px solid #000;">
                    Personal information
                </button>
                <button id="staff-tab-services" class="staff-profile-tab" style="background:none; border:none; padding:8px 0; cursor:pointer; color:var(--dark-grey);">
                    Services
                </button>
                <button id="staff-tab-appointments" class="staff-profile-tab" style="background:none; border:none; padding:8px 0; cursor:pointer; color:var(--dark-grey);">
                    Appointments
                </button>
            </div>
        </div>

        <div class="staff-profile-scroll-area">

        <!-- Personal Info Content -->
        <div id="staff-panel-personal" class="staff-panel-section" style="display:block;">
            <div class="info-card">
                <div class="info-card-grid">
                    <div>
                        <label class="info-field-label">First name</label>
                        <input id="staff-profile-firstname" type="text" class="info-input">
                    </div>
                    <div>
                        <label class="info-field-label">Last name</label>
                        <input id="staff-profile-lastname" type="text" class="info-input">
                    </div>
                    <div>
                        <label class="info-field-label">Staff role</label>
                        <input id="staff-profile-role" type="text" class="info-input">
                    </div>
                    <div>
                        <label class="info-field-label">Alias</label>
                        <input id="staff-profile-alias" type="text" class="info-input">
                    </div>
                    <div>
                        <label class="info-field-label">Email</label>
                        <input id="staff-profile-email" type="email" class="info-input">
                    </div>
                    <div>
                        <label class="info-field-label">Phone</label>
                        <input id="staff-profile-phone" type="text" class="info-input">
                    </div>
                </div>
            </div>

            <!-- Permissions Section -->
            <div class="info-card">
                <div class="info-card-title">Permissions</div>
                <div class="info-card-grid">
                    <div>
                        <label class="info-field-label">Permission group *</label>
                        <select id="staff-profile-permission-group" class="info-select">
                            <option value="admin">Admin</option>
                            <option value="provider">Service Provider</option>
                            <option value="frontdesk">Front Desk</option>
                        </select>
                    </div>
                    <div>
                        <label class="info-field-label">Assigned locations</label>
                        <select id="staff-profile-location" class="info-select">
                            <option value="renton">Renton</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Calendar Display Section -->
            <div class="info-card">
                <div class="info-card-title">Calendar display</div>
                <div style="margin-bottom: 20px;">
                    <label class="info-field-label">Internal display name *</label>
                    <input id="staff-profile-display-name" type="text" class="info-input" style="max-width: 350px;">
                </div>
                <div>
                    <label class="info-field-label">Color on calendar</label>
                    <div class="color-picker-container" id="staff-calendar-colors">
                        <div class="color-circle selected" style="background: #00bcd4;" data-color="#00bcd4"></div>
                        <div class="color-circle" style="background: #9b5de5;" data-color="#9b5de5"></div>
                        <div class="color-circle" style="background: #2ecc71;" data-color="#2ecc71"></div>
                        <div class="color-circle" style="background: #f39c12;" data-color="#f39c12"></div>
                        <div class="color-circle" style="background: #e91e63;" data-color="#e91e63"></div>
                        <div class="color-circle" style="background: #8bc34a;" data-color="#8bc34a"></div>
                        <div class="color-circle" style="background: #2196f3;" data-color="#2196f3"></div>
                        <div class="color-circle" style="background: #009688;" data-color="#009688"></div>
                        <div class="color-circle" style="background: #ef5350;" data-color="#ef5350"></div>
                        <div class="color-circle" style="background: #ce93d8;" data-color="#ce93d8"></div>
                        <div class="color-circle" style="background: #ffd54f;" data-color="#ffd54f"></div>
                        <div class="color-circle" style="background: #a1887f;" data-color="#a1887f"></div>
                        <div class="color-circle" style="background: #607d8b;" data-color="#607d8b"></div>
                    </div>
                </div>
            </div>

            <!-- Biography Section -->
            <div class="info-card">
                <div class="info-card-title">Biography</div>
                <div>
                    <label class="info-field-label">Bio</label>
                    <textarea id="staff-profile-bio" class="info-textarea" rows="4" placeholder="Brief biography of the staff member..."></textarea>
                </div>
            </div>
        </div>

        <div id="staff-panel-services" class="staff-panel-section" style="display:none;">
            <div style="margin-top:20px; overflow-x:auto;">
                <table class="services-table">
                    <thead>
                        <tr>
                            <th class="service-name"></th>
                            <th></th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Processing Time</th>
                            <th>Finishing Time</th>
                            <th>Transition Time</th>
                            <th>Business charge</th>
                            <th>Commission percentage</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="staff-panel-services-body">
                        <!-- Dynamically populated -->
                    </tbody>
                </table>
            </div>
        </div>

        <div id="staff-panel-appointments" class="staff-panel-section" style="display:none;">
            <p style="margin-top:8px; color:var(--dark-grey); font-size:14px;">View upcoming and past appointments for this staff member.</p>
        </div>
    </div>
    <div class="staff-profile-footer">
        <button id="staff-deactivate-btn" style="padding:8px 14px; border:1px solid #d00; background:transparent; color:#d00; border-radius:4px; cursor:pointer; font-weight:500;">Deactivate</button>
        <button id="staff-profile-save-btn" style="padding:8px 24px; border:none; background:#000; color:#fff; border-radius:4px; cursor:pointer; font-weight:500;">Save changes</button>
    </div>
</div>

<!-- Customize Service Modal -->
<div id="customize-service-modal" class="modal-overlay-custom">
    <div class="customize-modal">
        <button class="close-btn" onclick="closeCustomizeModal()">&times;</button>
        <h2 id="cust-modal-service-name">Service Name</h2>
        <p class="modal-subtitle">Overrides for <span id="cust-modal-staff-name" style="font-weight: 700; color: var(--brand-navy);">Staff Name</span></p>

        <div class="option-row" style="margin-bottom: 20px;">
            <label class="custom-checkbox-container" style="display: flex; align-items: center; gap: 15px; cursor: pointer; font-family: 'Montserrat', sans-serif; font-weight: 500;">
                <input type="checkbox" id="cust-assignable" checked style="width: 20px; height: 20px; accent-color: var(--brand-navy);">
                Assignable
            </label>
        </div>

        <div class="option-row" style="margin-bottom: 35px;">
            <label class="custom-checkbox-container" style="display: flex; align-items: center; gap: 15px; cursor: pointer; font-family: 'Montserrat', sans-serif; font-weight: 500;">
                <input type="checkbox" id="cust-bookable" checked style="width: 20px; height: 20px; accent-color: var(--brand-navy);">
                Bookable Online
            </label>
        </div>

        <button class="btn-update-service" onclick="closeCustomizeModal()" style="width: 100%; padding: 16px; background: var(--brand-navy); color: white; border: none; border-radius: 12px; font-weight: 700; font-family: 'Montserrat', sans-serif; cursor: pointer; transition: all 0.3s; box-shadow: 0 10px 20px rgba(15, 29, 44, 0.15);">Update Service</button>
    </div>
</div>

<!-- Add New Staff Modal -->
<div id="new-staff-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:2000; align-items:center; justify-content:center;">
    <div style="background:var(--light); padding:24px; border-radius:12px; width:400px; max-width:90%; position:relative;">
        <h2 style="margin-bottom:20px; font-size:20px; color:var(--brand-navy);">New Staff Member</h2>
        <button id="close-new-staff-modal" style="position:absolute; top:16px; right:16px; background:transparent; border:none; font-size:24px; cursor:pointer;">&times;</button>
        
        <form id="new-staff-form" style="display:flex; flex-direction:column; gap:16px;">
            <div style="display:flex; gap:16px;">
                <div style="flex:1;">
                    <label style="display:block; margin-bottom:6px; font-size:14px; font-weight:500;">First Name *</label>
                    <input type="text" name="firstname" required style="width:100%; padding:10px; border:1px solid var(--grey); border-radius:6px; outline:none;">
                </div>
                <div style="flex:1;">
                    <label style="display:block; margin-bottom:6px; font-size:14px; font-weight:500;">Last Name *</label>
                    <input type="text" name="lastname" required style="width:100%; padding:10px; border:1px solid var(--grey); border-radius:6px; outline:none;">
                </div>
            </div>
            
            <div>
                <label style="display:block; margin-bottom:6px; font-size:14px; font-weight:500;">Email *</label>
                <input type="email" name="email" required style="width:100%; padding:10px; border:1px solid var(--grey); border-radius:6px; outline:none;">
            </div>
            
            <div>
                <label style="display:block; margin-bottom:6px; font-size:14px; font-weight:500;">Phone</label>
                <input type="text" name="phone" style="width:100%; padding:10px; border:1px solid var(--grey); border-radius:6px; outline:none;">
            </div>
            
            <div>
                <label style="display:block; margin-bottom:6px; font-size:14px; font-weight:500;">Role</label>
                <input type="text" name="role" placeholder="e.g. Esthetician" style="width:100%; padding:10px; border:1px solid var(--grey); border-radius:6px; outline:none;">
            </div>
            
            <div>
                <label style="display:block; margin-bottom:6px; font-size:14px; font-weight:500;">Permission Group</label>
                <select name="permission_group" style="width:100%; padding:10px; border:1px solid var(--grey); border-radius:6px; outline:none;">
                    <option value="provider">Service Provider</option>
                    <option value="frontdesk">Front Desk</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" style="margin-top:10px; padding:12px; background:var(--brand-navy); color:white; border:none; border-radius:6px; font-weight:600; cursor:pointer;">
                Create Staff
            </button>
        </form>
    </div>
</div>

