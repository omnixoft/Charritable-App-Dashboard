 <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="./">
                        <span class="brand-logo">
                            <img src="{{ asset("logo.png") }}" alt="">
                           </span>
                        <h2 class="brand-text">   {{ trans('panel.site_title') }}</h2>
                    </a></li>
                {{-- <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li> --}}
            </ul>
        </div>

        <div class="shadow-bottom"></div>


        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item {{ request()->is("admin") || request()->is("admin") ? "active" : "" }}">
            <a class="d-flex align-items-center" href="{{ route("admin.home") }}">
                <i data-feather="home"></i><span class="menu-title text-truncate">{{ trans('global.dashboard') }}</span>
            </a>
        </li>
        <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
        @can('customer_access')
            <li class="nav-item {{ request()->is("admin/customers") || request()->is("admin/customers/*") ? "active" : "" }}">
                <a href="{{ route("admin.customers.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.customer.title') }}">{{trans('cruds.customer.title')}}</span>
                </a>
            </li>
        @endcan
        @can('donationtype_access')
        <li class="nav-item {{ request()->is("admin/donationtypes") || request()->is("admin/donationtypes/*") ? "active" : "" }}">
            <a href="{{ route("admin.donationtypes.index") }}" class="d-flex align-items-centerk">
                <i data-feather="activity"></i>
                <span class="menu-title text-truncate" data-i18n="{{ trans('cruds.donationtype.title') }}">   
                    {{ trans('cruds.donationtype.title') }}
                </span>
            </a>
        </li>
        @endcan
        @can('team_access')
            <li class="nav-item {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                <a href="{{ route("admin.teams.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.team.title') }}">{{ trans('cruds.team.title') }}</span>
                </a>
            </li>
        @endcan
        @can('social_solidarity_access')
            <li class="nav-item {{ request()->is("admin/social-solidarities") || request()->is("admin/social-solidarities/*") ? "active" : "" }}">
                <a href="{{ route("admin.social-solidarities.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="airplay"></i>
                    <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.socialSolidarity.title') }}">   
                        {{ trans('cruds.socialSolidarity.title') }}
                    </span>
                </a>
            </li>
        @endcan
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "active" : "" }} || {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "active" : "" }} || {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }} || {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "active" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i data-feather='check-square'></i>
                    <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.taskManagement.title') }}">   
                        {{ trans('cruds.taskManagement.title') }}
                    </span>
                </a>
                <ul class="menu-content">
                    @can('task_status_access')
                        <li class="nav-item {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "active" : "" }}">
                            <a href="{{ route("admin.task-statuses.index") }}" class="d-flex align-items-centerk">
                                <i data-feather="circle"></i>
                                <span class="menu-title text-truncate" data-i18n="{{ trans('cruds.taskStatus.title') }}">   
                                    {{ trans('cruds.taskStatus.title') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="nav-item {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "active" : "" }}">
                            <a href="{{ route("admin.task-tags.index") }}" class="d-flex align-items-centerk">
                                <i data-feather="circle"></i>
                                <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.taskTag.title') }}">   
                                    {{ trans('cruds.taskTag.title') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('task_access')
                        <li class="nav-item {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                            <a href="{{ route("admin.tasks.index") }}" class="d-flex align-items-centerk">
                                <i data-feather="circle"></i>
                                <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.task.title') }}">   
                                    {{ trans('cruds.task.title') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="nav-item {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "active" : "" }}">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="d-flex align-items-centerk">
                                <i data-feather="circle"></i>
                                <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.tasksCalendar.title') }}">   
                                    {{ trans('cruds.tasksCalendar.title') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('governorate_access')
            <li class="nav-item {{ request()->is("admin/governorates") || request()->is("admin/governorates/*") ? "active" : "" }}">
                <a href="{{ route("admin.governorates.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.governorate.title') }}">   
                        {{ trans('cruds.governorate.title') }}
                    </span>
                </a>
            </li>
        @endcan
        @can('wilayat_access')
            <li class="nav-item {{ request()->is("admin/wilayats") || request()->is("admin/wilayats/*") ? "active" : "" }}">
                <a href="{{ route("admin.wilayats.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.wilayat.title') }}">   
                        {{ trans('cruds.wilayat.title') }}
                    </span>
                </a>
            </li>
        @endcan
        <li class="navigation-header"><span data-i18n="Apps &amp; Pages">SYSTEM UTILITIES</span><i data-feather="more-horizontal"></i>
        @can('ayaht_access')
            <li class="nav-item {{ request()->is("admin/ayahts") || request()->is("admin/ayahts/*") ? "active" : "" }}">
                    <a href="{{ route("admin.ayahts.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="book"></i>
                    <span class="menu-title text-truncate" data-i18n="{{ trans('cruds.ayaht.title') }}">   
                        {{ trans('cruds.ayaht.title') }}
                    </span>
                </a>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="nav-item {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                <a href="{{ route("admin.user-alerts.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="bell"></i>
                    <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.userAlert.title') }}">   
                        {{ trans('cruds.userAlert.title') }}
                    </span>
                </a>
            </li>
        @endcan
        @can('banner_access')
            <li class="nav-item {{ request()->is("admin/banners") || request()->is("admin/banners/*") ? "active" : "" }}">
                <a href="{{ route("admin.banners.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="flag"></i>
                    <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.banner.title') }}">   
                        {{ trans('cruds.banner.title') }}
                    </span>
                </a>
            </li>
        @endcan
        @can('contact_us_access')
            <li class="nav-item {{ request()->is("admin/contactuses") || request()->is("admin/contactuses/*") ? "active" : "" }}">
                <a href="{{ route("admin.contactuses.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="phone"></i>
                    <span class="menu-title text-truncate" data-i18n="   {{ trans('cruds.contactUs.title') }}">   
                        {{ trans('cruds.contactUs.title') }}
                    </span>
                </a>
            </li>
        @endcan
        @can('feedback_access')
        <li class="nav-item {{ request()->is("admin/feedback") || request()->is("admin/feedback/*") ? "active" : "" }}">
            <a href="{{ route("admin.feedback.index") }}" class="d-flex align-items-centerk">
                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">
                </i>
                {{ trans('cruds.feedback.title') }}
            </a>
        </li>
    @endcan
    @can('faq_management_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }} || {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i data-feather="book"></i>
                <span class="menu-title text-truncate" data-i18n="   {{ trans('cruds.faqManagement.title') }}">   
                    {{ trans('cruds.faqManagement.title') }}
                </span>
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('faq_category_access')
                    <li class="nav-item {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                        <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="    {{ trans('cruds.faqCategory.title') }}">   
                                {{ trans('cruds.faqCategory.title') }}
                            </span>
                          
                        </a>
                    </li>
                @endcan
                @can('faq_question_access')
                      <li class="nav-item {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                         <a href="{{ route("admin.faq-questions.index") }}" class="d-flex align-items-centerk">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="    {{ trans('cruds.faqQuestion.title') }}">   
                                {{ trans('cruds.faqQuestion.title') }}
                            </span>
                         </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        {{-- @php($unread = \App\Models\QaTopic::unreadCount())
        <li class="nav-item {{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }}">
            <a href="{{ route("admin.messenger.index") }}" class="d-flex align-items-centerk">
                <i data-feather="mail"></i>
                <span class="menu-title text-truncate" data-i18n="{{ trans('global.messages') }}">   
                   {{ trans('global.messages') }}
                </span>
                @if($unread > 0)
                    <strong>( {{ $unread }} )</strong>
                @endif

            </a>
        </li>
        @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
            <li class="nav-item {{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }}">
                <a class="d-flex align-items-centerk" href="{{ route("admin.team-members.index") }}">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-users">
                    </i>
                    <span>{{ trans("global.team-members") }}</span>
                </a>
            </li>
        @endif --}}


        <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Reports</span><i data-feather="more-horizontal"></i>
            @can('donation_access')
            <li class="nav-item {{ request()->is("admin/report/donationRecord") || request()->is("admin/report/donationRecord/*") ? "active" : "" }}">
                <a href="{{ route("admin.report.donationRecord") }}" class="d-flex align-items-centerk">
                    <i data-feather="heart"></i>
                    <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.donation.title') }}">   
                        {{ trans('cruds.donation.title') }}
                    </span>                  
                    </a>
                </li>
            @endcan
            @can('social_solidarity_access')
            <li class="nav-item {{ request()->is("admin/report/socialRecord") || request()->is("admin/report/socialRecord/*") ? "active" : "" }}">
                <a href="{{ route("admin.report.socialRecord") }}" class="d-flex align-items-centerk">
                    <i data-feather="file"></i>
                    <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.socialSolidarity.title') }}">   
                        {{ trans('cruds.socialSolidarity.title') }}
                    </span>                   
                </a>
            </li>
        @endcan
        <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Application Settings</span><i data-feather="more-horizontal"></i>
        
            @can('app_version_setting_access')
            <li class="nav-item">
            <a href="{{ route("admin.app-version-settings.index") }}">
              <i data-feather="settings"></i>
                  <span class="menu-title text-truncate">
                     App Version Settings
                  </span>
              </a>
          </li>
                @endcan
                    @can('user_management_access')
        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }} || {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }} || {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i data-feather="settings"></i>
                <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.userManagement.title') }}">   
                    {{ trans('cruds.userManagement.title') }}
                </span>
            </a>
            <ul class="menu-content">
                @can('permission_access')
                    <li class="nav-item {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                        <a href="{{ route("admin.permissions.index") }}" class="d-flex align-items-centerk">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.permission.title') }}">   
                                {{ trans('cruds.permission.title') }}
                            </span>
                        </a>
                    </li>
                @endcan
                @can('role_access')
                    <li class="nav-item {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                        <a href="{{ route("admin.roles.index") }}" class="d-flex align-items-centerk">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.role.title') }}">   
                                {{ trans('cruds.role.title') }}
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                    <li class="nav-item {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                        <a href="{{ route("admin.users.index") }}" class="d-flex align-items-centerk">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.user.title') }}">   
                                {{ trans('cruds.user.title') }}
                            </span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan


    @can('audit_log_access')
    <li class="nav-item {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
        <a href="{{ route("admin.audit-logs.index") }}" class="d-flex align-items-centerk">
            <i data-feather="file"></i>
            <span class="menu-title text-truncate" data-i18n="  {{ trans('cruds.auditLog.title') }}">   
                {{ trans('cruds.auditLog.title') }}
            </span>
        </a>
    </li>
    @endcan

            @can('thawani_setting_access')
                <li class="nav-item {{ request()->is("admin/thawani-settings") || request()->is("admin/thawani-settings/*") ? "active" : "" }}">
                <a href="{{ route("admin.thawani-settings.index") }}" class="d-flex align-items-centerk">
                    <i data-feather="settings"></i>
                        <span class="menu-title text-truncate" data-i18n="{{ trans('cruds.thawaniSetting.title') }}">   
                            {{ trans('cruds.thawaniSetting.title') }}
                        </span>       
                </a>
            </li>
            @endcan

            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class=" nav-item {{ request()->is("profile/password") || request()->is("profile/password*") ? "active" : "" }}">
                        <a class="d-flex align-items-centerk" href="{{ route('profile.password.edit') }}">
                            <i data-feather="lock"></i>
                            <span class="menu-title text-truncate" data-i18n="   {{ trans('global.change_password') }}">   
                                {{ trans('global.change_password') }}
                            </span>                          
                        </a>
                    </li>
                @endcan
            @endif         
    </ul>
</div>
</div>