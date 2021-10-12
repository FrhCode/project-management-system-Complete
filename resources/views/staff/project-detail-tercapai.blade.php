<span style="font-weight: 600;">
    Target peserta terdidik :
</span>
<span class="project-tercapai--inputDbl">
    <span class="tercapai-value">{{ number_format($project->tercapai, 0, ',', '.') }}</span>
    /

    <span class="target-value">{{ number_format($project->target, 0, ',', '.') }}</span>
</span>
({{ number_format(((float) $project->tercapai / $project->target) * 100, 1, '.', '') . '%' }})
