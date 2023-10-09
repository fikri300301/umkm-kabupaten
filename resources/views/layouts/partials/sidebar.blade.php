<x-sidebar.sidebar :href="route('dashboard')" :logo="asset('/logo/KABINET.png')">

				{{-- <x-sidebar.sidebar-item name="Halaman Utama" :link="route('welcome')" icon="bi bi-arrow-90deg-left" /> --}}
				{{-- dashbord --}}
				@can('show-dashboard')
								<x-sidebar.side-title title="Dashboard" />
								<x-sidebar.sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill" />
				@endcan

				{{-- Master --}}
				@canany(['show-kecamatan', 'show-bidang','show-category','show-pelatihan',])
								<x-sidebar.side-title title="Manage Master" />
								<x-sidebar.sidebar-item name="Master" :link="route('dashboard')" icon="bi bi-stack">
												<x-sidebar.sidebar-sub-item name="Bidang" :link="route('manage-bidang')" />
												<x-sidebar.sidebar-sub-item name="Kelas" :link="route('manage-kelas')" />
												
								</x-sidebar.sidebar-item>
				@endcanany

				@canany(['show-kecamatan', 'show-desa'])
								<x-sidebar.side-title title="Regional" />
								<x-sidebar.sidebar-item name="Manajemen Kecamatan Dan Desa" :link="route('dashboard')" icon="bi bi-stack">
												<x-sidebar.sidebar-sub-item name="Kecamatan" :link="route('manage-kecamatan')" />
												<x-sidebar.sidebar-sub-item name="Desa" :link="route('manage-desa')" />
								</x-sidebar.sidebar-item>
				@endcanany

				@canany(['show-pelatihan', 'show-category-pelatihan'])
								<x-sidebar.side-title title="Pelatihan" />
								<x-sidebar.sidebar-item name="Manajemen Pelatihan Dan Category" :link="route('dashboard')" icon="bi bi-stack">
												<x-sidebar.sidebar-sub-item name="Pelatihan" :link="route('manage-pelatihan')" />
												<x-sidebar.sidebar-sub-item name="Category " :link="route('manage-category-pel')" />
								</x-sidebar.sidebar-item>
				@endcanany

				@can('show-bantuan')
								<x-sidebar.side-title title="Bantuan" />
								<x-sidebar.sidebar-item name="Manajemen Bantuan" :link="route('manage-bantuan')" icon="bi bi-person-lines-fill" />
				@endcan

				@can('show-perizinan')
								<x-sidebar.side-title title="Perizinan" />
								<x-sidebar.sidebar-item name="Manajemen Perizinan" :link="route('manage-perizinan')" icon="bi bi-person-lines-fill" />
				@endcan

				{{-- manage Contact
				<x-sidebar.side-title title="Kontak" />
				<x-sidebar.sidebar-item name="Manajemen Kontak" :link="route('manage-contact')" icon="bi bi-chat-left" /> --}}

				{{-- user --}}
				@can('show-user')
								<x-sidebar.side-title title="Users" />
								<x-sidebar.sidebar-item name="Manajemen Users" :link="route('manage-users')" icon="bi bi-person-lines-fill" />
				@endcan

				

				{{-- config web
				@can('show-config')
								<x-sidebar.side-title title="Config Website" />
								<x-sidebar.sidebar-item name="Akun Pembayaran" :link="route('akun-pembayaran')" icon="bi bi-wallet2" />
								<x-sidebar.sidebar-item name="Profile BEM FMIPA" :link="route('profile-bem')" icon="bi bi-person-square" />
				@endcan --}}

				{{-- role and permission --}}
				@canany(['show-role', 'show-permission'])
								<x-sidebar.side-title title="Role and Permission" />
								<x-sidebar.sidebar-item name="Manajemen Role Permission" :link="route('dashboard')" icon="bi bi-stack">
												<x-sidebar.sidebar-sub-item name="Role" :link="route('manage-role')" />
												<x-sidebar.sidebar-sub-item name="Permission" :link="route('manage-permission')" />
								</x-sidebar.sidebar-item>
				@endcanany

</x-sidebar.sidebar>
