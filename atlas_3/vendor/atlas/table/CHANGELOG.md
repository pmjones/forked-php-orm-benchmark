# CHANGELOG

## 1.0.1

This release incorporates some documentation fixes and an added benchmarking
script at `tests/bench.php`.

## 1.0.0

First stable release.

## 1.0.0-beta4

TableEvent::beforeInsertRow() now returns `?array` instead of `void`. The
returned array will be used for the insert values; this allows consumers to
explicitly control which values will be inserted, and to validate the values
early on. (If a null is returned, the insert will use `$row->getArrayCopy()`.)

Likewise, TableEvent::beforeUpdateRow() now returns `?array` instead of `void`.
The returned array will be used for the update values; this allows consumers to
explicitly control which values will be updated, and to validate the values
early on. (If a null is returned, the update will use `$row->getArrayDiff()`.)

These are both BC breaks for implementors of TableEvents::beforeInsertRow() and
beforeUpdateRow().

## 1.0.0-beta3

Added methods Table::selectRow() and selectRows() so you can pass in an
externally-constructed Select object to fetch rows by primary key; this is
useful with, e.g., MapperSelect queries modified by their own events.

## 1.0.0-beta2

This release introduces one BC-breaking change from beta1: the TableEvents
methods have been renamed from (before|modify|after)(Insert|Update|Delete) to
append the word Row. For example, TableEvents::beforeUpate() is now
TableEvents::beforeUpdateRow(). If you have implemented these methods in your
custom TableEvents classes, you will need to change to the new names; the
signatures and logic remain otherwise identical. There is no effect on generated
classes.

There are new modify(Insert|Update|Delete) TableEvents methods that now apply
to insert(), update(), and delete() respectively. These allow you a chance to
modify the table-wide operation before working with the query object directly.

This release also adds a PHPStorm metadata resource, and updates the docs.

## 1.0.0-beta1

This release adds type-specific _TableSelect_ classes (to aid IDEs with return
typehint completion) and a new `Row::getArrayInit()` method.

## 1.0.0-alpha1

Initial release.
