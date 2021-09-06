function data() {
  return {
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    isProMenuOpen: false,
    toggleProMenu() {
      this.isProMenuOpen = !this.isProMenuOpen
    },
    closeProMenu() {
      this.isProMenuOpen = false
    },
    isBillingMenuOpen: false,
    toggleBillingMenu() {
      this.isBillingMenuOpen = !this.isBillingMenuOpen
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    isManagementMenuOpen: false,
    toggleManagementMenu() {
      this.isManagementMenuOpen = !this.isManagementMenuOpen
    },
    isUserManagementMenuOpen: false,
    toggleUserManagementMenu() {
      this.isUserManagementMenuOpen = !this.isUserManagementMenuOpen
    },
    isAdminSettingsMenuOpen: false,
    toggleAdminSettingsMenu() {
      this.isAdminSettingsMenuOpen = !this.isAdminSettingsMenuOpen
    },
    isMarketplaceMenuOpen: false,
    toggleMarketplaceMenu() {
      this.isMarketplaceMenuOpen = !this.isMarketplaceMenuOpen
    },
    isRequestManagementMenuOpen: false,
    toggleRequestManagementMenu() {
      this.isRequestManagementMenuOpen = !this.isRequestManagementMenuOpen
    },


    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
  }
}
