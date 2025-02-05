<?php

use Latte\Runtime as LR;

/** source: /var/www/html/app/Presenters/templates/Results/default.latte */
final class Template1ef78e4c22 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['content' => 'blockContent', 'title' => 'blockTitle'],
	];


	public function main(): array
	{
		extract($this->params);
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['row' => '25'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '<div id="banner">
';
		$this->renderBlock('title', get_defined_vars()) /* line 5 */;
		echo '</div>

<div id="content">
	<h1>Výsledky dotazníku</h1>

';
		/* line 11 */ $_tmp = $this->global->uiControl->getComponent("filterForm");
		if ($_tmp instanceof Nette\Application\UI\Renderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
		echo '
	<table>
		<thead>
		<tr>
			<th>ID</th>
			<th>Jméno</th>
			<th>Komentář</th>
			<th>Souhlas</th>
			<th>Zájmy</th>
			<th>Datum</th>
		</tr>
		</thead>
		<tbody>
';
		$iterations = 0;
		foreach ($results as $row) /* line 25 */ {
			echo '			<tr>
				<td>';
			echo LR\Filters::escapeHtmlText($row->id) /* line 27 */;
			echo '</td>
				<td>';
			echo LR\Filters::escapeHtmlText($row->name) /* line 28 */;
			echo '</td>
				<td>';
			echo $row->comment /* line 29 */;
			echo '</td>
				<td>';
			if ($row->conditions) /* line 30 */ {
				echo 'Ano';
			} else /* line 30 */ {
				echo 'Ne';
			}
			echo '</td>
				<td>';
			echo LR\Filters::escapeHtmlText($row->interests) /* line 31 */;
			echo '</td>
				<td>';
			echo LR\Filters::escapeHtmlText(($this->filters->date)($row->createdAt, 'd.m.Y H:i')) /* line 32 */;
			echo '</td>
			</tr>
';
			$iterations++;
		}
		echo '		</tbody>
	</table>

';
		if ($pageCount > 1) /* line 38 */ {
			echo '	<div class="pagination">
';
			for ($i = 1;
			$i <= $pageCount;
			$i++) /* line 41 */ {
				if ($i === $paginator.'page') /* line 42 */ {
					echo '				<strong>';
					echo LR\Filters::escapeHtmlText($i) /* line 43 */;
					echo '</strong>
';
				} else /* line 44 */ {
					echo '				<a href="';
					echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("this", ['page' => $i])) /* line 45 */;
					echo '">';
					echo LR\Filters::escapeHtmlText($i) /* line 45 */;
					echo '</a>
';
				}
			}
			echo '	</div>
';
		}
		echo '
</div>

<style>
	html { font: normal 18px/1.3 Georgia, "New York CE", utopia, serif; color: #666; -webkit-text-stroke: 1px rgba(0,0,0,0); overflow-y: scroll; }
	body { background: #3484d2; color: #333; margin: 2em auto; padding: 0 .5em; max-width: 600px; min-width: 320px; }

	a { color: #006aeb; padding: 3px 1px; }
	a:hover, a:active, a:focus { background-color: #006aeb; text-decoration: none; color: white; }

	#banner { border-radius: 12px 12px 0 0; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAB5CAMAAADPursXAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGBQTFRFD1CRDkqFDTlmDkF1D06NDT1tDTNZDk2KEFWaDTZgDkiCDTtpDT5wDkZ/DTBVEFacEFOWD1KUDTRcDTFWDkV9DkR7DkN4DkByDTVeDC9TDThjDTxrDkeADkuIDTRbDC9SbsUaggAAAEdJREFUeNqkwYURgAAQA7DH3d3335LSKyxAYpf9vWCpnYbf01qcOdFVXc14w4BznNTjkQfsscAdU3b4wIh9fDVYc4zV8xZgAAYaCMI6vPgLAAAAAElFTkSuQmCC); }

	h1 { font: inherit; color: white; font-size: 50px; line-height: 121px; margin: 0; padding-left: 4%; background: url(https://files.nette.org/images/logo-nette@2.png) no-repeat 95%; background-size: 130px auto; text-shadow: 1px 1px 0 rgba(0, 0, 0, .9); }
	@media (max-width: 600px) {
		h1 { background: none; font-size: 40px; }
	}

	#content { background: white; border: 1px solid #eff4f7; border-radius: 0 0 12px 12px; padding: 10px 4%; overflow: hidden; }

	h2 { font: inherit; padding: 1.2em 0; margin: 0; }

	img { border: none; float: right; margin: 0 0 1em 3em; }
</style>
';
	}


	/** {block title} on line 5 */
	public function blockTitle(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '	<h1>results!</h1>
';
	}

}
