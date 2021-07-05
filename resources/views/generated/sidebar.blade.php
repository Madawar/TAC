 <li x-data="{ {{  request()->routeIs('carrier.*') ? 'open: true' : 'open: false' }}}" @click.away="{{  request()->routeIs('carrier.*') ? 'open = true' : 'open = false' }}">
                <a   @click="open = true" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                    Carriers
                    </a>
                <ul class="menu" x-show="open"   x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-700"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90">
                    <li>
                        <a href="{{ action([CarrierController::class, 'create']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Create Carrier

                        </a>
                    </li>
                    <li>
                        <a href="{{ action([CarrierController::class, 'index']) }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                              </svg>
                            View Carriers

                        </a>
                    </li>
                </ul>
            </li>

 <li x-data="{ {{  request()->routeIs('flight.*') ? 'open: true' : 'open: false' }}}" @click.away="{{  request()->routeIs('flight.*') ? 'open = true' : 'open = false' }}">
                <a   @click="open = true" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                    Flights
                    </a>
                <ul class="menu" x-show="open"   x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-700"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90">
                    <li>
                        <a href="{{ action([FlightController::class, 'create']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Create Flight

                        </a>
                    </li>
                    <li>
                        <a href="{{ action([FlightController::class, 'index']) }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                              </svg>
                            View Flights

                        </a>
                    </li>
                </ul>
            </li>

 <li x-data="{ {{  request()->routeIs('schedule.*') ? 'open: true' : 'open: false' }}}" @click.away="{{  request()->routeIs('schedule.*') ? 'open = true' : 'open = false' }}">
                <a   @click="open = true" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                    Flight Schedules
                    </a>
                <ul class="menu" x-show="open"   x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-700"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90">
                    <li>
                        <a href="{{ action([FlightScheduleController::class, 'create']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Create Flight Schedule

                        </a>
                    </li>
                    <li>
                        <a href="{{ action([FlightScheduleController::class, 'index']) }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                              </svg>
                            View Flight Schedules

                        </a>
                    </li>
                </ul>
            </li>

 <li x-data="{ {{  request()->routeIs('service.*') ? 'open: true' : 'open: false' }}}" @click.away="{{  request()->routeIs('service.*') ? 'open = true' : 'open = false' }}">
                <a   @click="open = true" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                    Services
                    </a>
                <ul class="menu" x-show="open"   x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-700"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90">
                    <li>
                        <a href="{{ action([ServiceListController::class, 'create']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Create Service

                        </a>
                    </li>
                    <li>
                        <a href="{{ action([ServiceListController::class, 'index']) }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                              </svg>
                            View Services

                        </a>
                    </li>
                </ul>
            </li>
 <li x-data="{ {{  request()->routeIs('user.*') ? 'open: true' : 'open: false' }}}" @click.away="{{  request()->routeIs('user.*') ? 'open = true' : 'open = false' }}">
                <a   @click="open = true" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                    Users
                    </a>
                <ul class="menu" x-show="open"   x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-700"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90">
                    <li>
                        <a href="{{ action([UserController::class, 'create']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Create User

                        </a>
                    </li>
                    <li>
                        <a href="{{ action([UserController::class, 'index']) }}">

                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                              </svg>
                            View Users

                        </a>
                    </li>
                </ul>
            </li>

