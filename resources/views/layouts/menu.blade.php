<li class="nav-item">
    <a href="{{ route('calonSiswas.index') }}" class="nav-link {{ Request::is('calonSiswas*') ? 'active' : '' }}">
        <p>Calon Siswas</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('jalurs.index') }}" class="nav-link {{ Request::is('jalurs*') ? 'active' : '' }}">
        <p>Jalurs</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('minats.index') }}" class="nav-link {{ Request::is('minats*') ? 'active' : '' }}">
        <p>Minats</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('soalTests.index') }}" class="nav-link {{ Request::is('soalTests*') ? 'active' : '' }}">
        <p>Soal Tests</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('jalurPartisipasis.index') }}"
       class="nav-link {{ Request::is('jalurPartisipasis*') ? 'active' : '' }}">
        <p>Jalur Partisipasis</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('calonSiswaMinats.index') }}"
       class="nav-link {{ Request::is('calonSiswaMinats*') ? 'active' : '' }}">
        <p>Calon Siswa Minats</p>
    </a>
</li>


