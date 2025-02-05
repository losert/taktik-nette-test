<?php declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\Paginator;


final class ResultsPresenter extends Nette\Application\UI\Presenter
{
    private $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    public function renderDefault(): void
    {
        // Načtení nastavení filtrování, řazení a stránkování ze session
        $session = $this->getSession('results');
        $filter = $session->filter ?? [];
        $sort   = $session->sort ?? ['createdAt' => 'DESC'];
        $page   = $session->page ?? 1;

        $selection = $this->database->table('survey');

        // Příklad filtru podle jména
        if (!empty($filter['name'])) {
            $selection->where('name LIKE ?', '%' . $filter['name'] . '%');
        }

        // Aplikace řazení
        foreach ($sort as $column => $order) {
            $selection->order("$column $order");
        }

        // Nastavení stránkování
        $paginator = new Paginator;
        $paginator->setItemCount((int) $selection->count());
        $paginator->setItemsPerPage(10);
        $paginator->setPage($page);

        $results = $selection->limit($paginator->getLength(), $paginator->getOffset());

        $this->template->results   = $results;
        $this->template->paginator = $paginator;
        $this->template->pageCount = $paginator->getPageCount();
        $this->template->filter    = $filter;
        $this->template->sort      = $sort;
    }

    protected function createComponentFilterForm(): Form
    {
        $form = new Form;
        $form->addText('name', 'Jméno:');
        $form->addSelect('sort', 'Řadit podle:', [
            'name'       => 'Jméno',
            'created_at' => 'Datum',
        ]);
        $form->addRadioList('order', 'Směr řazení:', [
            'ASC'  => 'Vzestupně',
            'DESC' => 'Sestupně',
        ]);
        $form->addSubmit('filter', 'Filtrovat');
        $form->onSuccess[] = [$this, 'filterFormSucceeded'];
        return $form;
    }

    public function filterFormSucceeded(Form $form, \stdClass $values): void
    {
        // Uložení hodnot do session a resetování stránky
        $session = $this->getSession('results');
        $session->filter = [
            'name' => $values->name,
        ];
        $session->sort = [
            $values->sort => $values->order,
        ];
        $session->page = 1;

        $this->redirect('this');
    }
}
