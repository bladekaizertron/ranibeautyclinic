        <!-- Clients Section (blank list) -->
        <div id="clients-section" class="main-section" style="display: none;">
            <div class="clients-header">
                <h1>Clients</h1>
                <div class="clients-actions">
                    <a href="#">Export</a>
                    <a href="#">Merge clients</a>
                    <button>Add client</button>
                </div>
            </div>

            <div class="clients-stats-line">
                <span><b>0 clients</b> in your directory</span>
                <div class="add-filter">
                    <i class='bx bx-filter'></i>
                    <span>Add filter</span>
                </div>
            </div>

            <div class="clients-search-container">
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search for a name, phone number or email">
            </div>

            <div class="clients-table-container">
                <table class="clients-table">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Client name</th>
                            <th style="width: 15%;">Marketing Status</th>
                            <th style="width: 15%;">Phone number</th>
                            <th style="width: 25%;">Email</th>
                            <th style="width: 20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="clients-table-body">
                        <!-- Blank for now as requested -->
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: var(--dark-grey); padding: 40px 0;">
                                            No clients found in your directory.
                                        </td>
                                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
